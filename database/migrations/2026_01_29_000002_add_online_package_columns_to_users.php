<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOnlinePackageColumnsToUsers extends Migration
{
    /**
     * Add separate columns for the 4 online packages (by days).
     * Keeps existing `package` column for admin-assigned packages only.
     */
    public function up()
    {
        if (!Schema::hasTable('users')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'online_package')) {
                $table->string('online_package', 50)->nullable()->index();
            }
            if (!Schema::hasColumn('users', 'online_package_started_at')) {
                $table->timestamp('online_package_started_at')->nullable();
            }
            if (!Schema::hasColumn('users', 'online_package_expires_at')) {
                $table->timestamp('online_package_expires_at')->nullable();
            }
        });
    }

    public function down()
    {
        if (!Schema::hasTable('users')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'online_package_expires_at')) {
                $table->dropColumn('online_package_expires_at');
            }
            if (Schema::hasColumn('users', 'online_package_started_at')) {
                $table->dropColumn('online_package_started_at');
            }
            if (Schema::hasColumn('users', 'online_package')) {
                $table->dropColumn('online_package');
            }
        });
    }
}
