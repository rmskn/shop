<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
            'title' => 'Vegetable'
        ]);

        DB::table('sections')->insert([
            'title' => 'Food'
        ]);

        DB::table('sections')->insert([
            'title' => 'Clothes'
        ]);
    }
}
