<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'title' => 'Apple',
            'description' => 'Very tasty apple',
            'price' => 100,
            'pictures' => json_encode(
                ['apple1.jpg', 'apple2.jpg'],
                JSON_THROW_ON_ERROR
            )
        ]);

        DB::table('products')->insert([
            'title' => 'Chocolate',
            'description' => 'Very tasty chocolate',
            'price' => 170,
            'pictures' => json_encode(
                ['chocolate1.jpg'],
                JSON_THROW_ON_ERROR
            )
        ]);

        DB::table('products')->insert([
            'title' => 'Jacket',
            'description' => 'Very warm jacket',
            'price' => 270,
            'pictures' => json_encode(
                ['jacket1.jpg'],
                JSON_THROW_ON_ERROR
            )
        ]);
    }
}
