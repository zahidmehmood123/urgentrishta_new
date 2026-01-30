<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlinePackagesTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('online_packages')) {
            return;
        }

        Schema::create('online_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dataid', 50)->unique();
            $table->string('name');
            // JSON meta: price, currency, duration_days, duration_label
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('online_packages');
    }
}

