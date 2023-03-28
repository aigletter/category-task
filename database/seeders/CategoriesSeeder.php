<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < 20; $i++) {
            DB::table('categories')->insert([
                'id' => $i,
                'parent_id' => $i !== 1 && rand(0, 1) ? rand(1, $i) : null,
                //'name' => Str::random(10),
            ]);
        }
    }
}
