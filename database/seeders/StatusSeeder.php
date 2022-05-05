<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            'code' => 0,
            'title' => 'Order is accepted'
        ]);

        DB::table('statuses')->insert([
            'code' => 1,
            'title' => 'Order in processing'
        ]);

        DB::table('statuses')->insert([
            'code' => 2,
            'title' => 'Order is shipping'
        ]);

        DB::table('statuses')->insert([
            'code' => 3,
            'title' => 'Order is finished'
        ]);

        DB::table('statuses')->insert([
            'code' => 4,
            'title' => 'Order is canceled'
        ]);
    }
}
