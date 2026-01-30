<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'eiu',
        'api/*',
        'login',
        // Stripe webhook lives under api routes (no CSRF there)
        'api/stripe/webhook',
    ];

    
}
