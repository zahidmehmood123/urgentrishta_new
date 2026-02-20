<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('payments')) {
            return;
        }

        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('online_package_id')->nullable()->index();

            $table->string('gateway', 50)->default('paypal')->index();
            $table->string('reference', 64)->unique();

            $table->string('currency', 10)->default('USD');
            $table->decimal('amount', 10, 2);

            $table->string('status', 30)->default('initiated')->index(); // initiated|pending|paid|failed|cancelled
            $table->string('gateway_txid', 150)->nullable()->index(); // PayPal order id
            $table->text('gateway_payload')->nullable();

            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}

