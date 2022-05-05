<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            'user_id' => 1,
            'price' => 370,
            'status' => 0,
            'date' => new \DateTime()
        ]);

        DB::table('orders')->insert([
            'user_id' => 1,
            'price' => 100,
            'status' => 1,
            'date' => new \DateTime()
        ]);

        DB::table('orders')->insert([
            'user_id' => 2,
            'price' => 270,
            'status' => 2,
            'date' => new \DateTime()
        ]);

    }
}
