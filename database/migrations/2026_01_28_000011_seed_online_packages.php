<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SeedOnlinePackages extends Migration
{
    public function up()
    {
        if (!DB::getSchemaBuilder()->hasTable('online_packages')) {
            return;
        }

        $packages = [
            [
                'dataid' => 'ONLINE_6M',
                'name' => 'Online - 6 Months',
                'description' => json_encode([
                    'price' => 150,
                    'currency' => 'USD',
                    'duration_days' => 180,
                    'duration_label' => '6 months',
                ]),
            ],
            [
                'dataid' => 'ONLINE_3M',
                'name' => 'Online - 3 Months',
                'description' => json_encode([
                    'price' => 80,
                    'currency' => 'USD',
                    'duration_days' => 90,
                    'duration_label' => '3 months',
                ]),
            ],
            [
                'dataid' => 'ONLINE_1M',
                'name' => 'Online - 1 Month',
                'description' => json_encode([
                    'price' => 29,
                    'currency' => 'USD',
                    'duration_days' => 30,
                    'duration_label' => '1 month',
                ]),
            ],
            [
                'dataid' => 'ONLINE_1W',
                'name' => 'Online - Weekly',
                'description' => json_encode([
                    'price' => 19,
                    'currency' => 'USD',
                    'duration_days' => 7,
                    'duration_label' => 'weekly',
                ]),
            ],
        ];

        foreach ($packages as $p) {
            DB::table('online_packages')->updateOrInsert(
                ['dataid' => $p['dataid']],
                [
                    'name' => $p['name'],
                    'description' => $p['description'],
                    'is_active' => 1,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }

    public function down()
    {
        if (!DB::getSchemaBuilder()->hasTable('online_packages')) {
            return;
        }

        DB::table('online_packages')
            ->whereIn('dataid', ['ONLINE_6M', 'ONLINE_3M', 'ONLINE_1M', 'ONLINE_1W'])
            ->delete();
    }
}

