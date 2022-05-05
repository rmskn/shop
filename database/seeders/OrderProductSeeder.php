<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_products')->insert([
            'product_id' => 1,
            'order_id' => 1,
            'count' => 2,
            'price' => 100
        ]);

        DB::table('order_products')->insert([
            'product_id' => 2,
            'order_id' => 1,
            'count' => 1,
            'price' => 170
        ]);

        DB::table('order_products')->insert([
            'product_id' => 1,
            'order_id' => 2,
            'count' => 1,
            'price' => 100
        ]);

        DB::table('order_products')->insert([
            'product_id' => 3,
            'order_id' => 3,
            'count' => 1,
            'price' => 270
        ]);

    }
}
