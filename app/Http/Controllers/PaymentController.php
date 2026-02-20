<?php

namespace App\Http\Controllers;

use App\OnlinePackage;
use App\Payment;
use App\Services\PayPalService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Start checkout for an online package (PayPal Checkout).
     * User cannot subscribe to another online package until the current one expires.
     */
    public function startOnlinePackageCheckout($packageId)
    {
        /** @var User $user */
        $user = User::retrieveUserObject();

        if ($user->hasActiveOnlinePackage()) {
            $exp = $user->online_package_expires_at;
            $expFormatted = $exp ? (\Illuminate\Support\Carbon::parse($exp)->format('j M Y')) : '';
            Session::flash('message', 'warning|You already have an active online subscription.'
                . ($expFormatted ? ' It is valid until ' . $expFormatted . '. You can subscribe again after it expires.' : ' You can subscribe again after it expires.'));
            return redirect('packages');
        }

        $package = OnlinePackage::where('is_active', true)->findOrFail($packageId);
        $meta = $package->meta();

        $amount = isset($meta['price']) ? (float)$meta['price'] : 0.0;
        if ($amount <= 0) {
            abort(500, 'Package price is not configured.');
        }

        $payment = Payment::create([
            'user_id' => $user->id,
            'online_package_id' => $package->id,
            'gateway' => 'paypal',
            'reference' => (string)Str::uuid(),
            'currency' => (string)($meta['currency'] ?? 'USD'),
            'amount' => $amount,
            'status' => 'initiated',
        ]);

        $paypal = new PayPalService();
        if (!$paypal->isConfigured()) {
            Log::warning('PayPal checkout attempted but PayPal is not configured (missing PAYPAL_CLIENT_ID or PAYPAL_SECRET in .env)');
            Session::flash('message', 'danger|PayPal is not configured. Please set PAYPAL_CLIENT_ID and PAYPAL_SECRET in .env (use Sandbox credentials from developer.paypal.com).');
            return redirect('packages');
        }

        $order = $paypal->createOrder($payment, $package);

        if (!$order) {
            Log::warning('PayPal createOrder returned null', ['payment_reference' => $payment->reference]);
            Session::flash('message', 'danger|Unable to start PayPal checkout. Check storage/logs/laravel.log for details, or verify your PayPal Sandbox credentials in .env.');
            return redirect('packages');
        }

        $payment->gateway_txid = $order['order_id'];
        $payment->save();

        return redirect()->away($order['approval_url']);
    }

    public function paypalSuccess(Request $request, $reference)
    {
        $payment = Payment::where('reference', $reference)->first();
        if (!$payment) {
            Session::flash('message', 'danger|Payment not found.');
            return redirect('home');
        }

        $token = $request->query('token'); // PayPal order ID
        if ($payment->status !== 'paid' && !empty($token)) {
            $this->tryCapturePayPalOrder($payment, $token);
        }

        $payment->refresh();
        if ($payment->status === 'paid') {
            Session::flash('message', 'success|Payment successful. Your package is now active. You can search Soul Mates.');
        } else {
            Session::flash('message', 'info|Payment not yet completed. If you paid, your package will be activated shortly.');
        }

        return redirect('home');
    }

    /**
     * Capture PayPal order and mark payment as paid, then activate package.
     */
    private function tryCapturePayPalOrder(Payment $payment, string $orderId): void
    {
        try {
            $paypal = new PayPalService();
            if (!$paypal->captureOrder($orderId)) {
                return;
            }
            $payment->status = 'paid';
            $payment->paid_at = now();
            $payment->save();
            $this->activatePaidOnlinePackage($payment);
        } catch (\Throwable $e) {
            Log::warning('PayPal capture failed on return', ['reference' => $payment->reference, 'error' => $e->getMessage()]);
        }
    }

    public function paypalCancel(Request $request, $reference)
    {
        $payment = Payment::where('reference', $reference)->first();
        if ($payment && $payment->status === 'initiated') {
            $payment->status = 'cancelled';
            $payment->save();
        }

        Session::flash('message', 'warning|Payment cancelled.');
        return redirect('packages');
    }

    /**
     * Activate the purchased online package for the user.
     * Uses User::activateOnlinePackage() which sets only online_package, online_package_started_at,
     * online_package_expires_at (does not touch admin package column).
     */
    private function activatePaidOnlinePackage(Payment $payment): void
    {
        $user = User::find($payment->user_id);
        $package = OnlinePackage::find($payment->online_package_id);
        if (!$user || !$package) {
            return;
        }

        $user->activateOnlinePackage($package);
        User::retrieveUserObject($user->dataid, true);
    }
}
