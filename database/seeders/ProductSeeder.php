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
                ['../../public/images/Products/1/apple1.jpg', '../../public/images/Products/1/apple2.jpg'],
                JSON_THROW_ON_ERROR
            )
        ]);

        DB::table('products')->insert([
            'title' => 'Chocolate',
            'description' => 'Very tasty chocolate',
            'price' => 170,
            'pictures' => json_encode(
                ['../../public/images/Products/2/chocolate1.jpg', '../../public/images/Products/2/chocolate2.jpg'],
                JSON_THROW_ON_ERROR
            )
        ]);

        DB::table('products')->insert([
            'title' => 'Jacket',
            'description' => 'Very warm jacket',
            'price' => 270,
            'pictures' => json_encode(
                ['../../public/images/Products/3/jacket1.jpg'],
                JSON_THROW_ON_ERROR
            )
        ]);
    }
}
