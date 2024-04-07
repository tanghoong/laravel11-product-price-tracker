<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 20; $i++) {
            DB::table('products')->insert([
                'name' => 'Dummy product '.Str::random(10),
                // random float amount with decimal point
                'price' => rand(100, 1000) + (rand(0, 99) / 100),
                'description' => Str::random(100),
                'is_published' => 'no',
            ]);
        }
    }
}
