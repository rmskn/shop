<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'product_id' => 1,
            'section_id' => 1
        ]);

        DB::table('categories')->insert([
            'product_id' => 1,
            'section_id' => 2
        ]);

        DB::table('categories')->insert([
            'product_id' => 2,
            'section_id' => 2
        ]);

        DB::table('categories')->insert([
            'product_id' => 3,
            'section_id' => 3
        ]);
    }
}
