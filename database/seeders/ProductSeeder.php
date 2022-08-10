<?php

namespace Database\Seeders;

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

            [
                'name' => 'Iphone',
                'description' => 'Description',
                'price' => 1200,

            ],
            [
                'name' => 'Honor',
                'description' => 'Description',
                'price' => 120,

            ],
            [
                'name' => 'Samsung',
                'description' => 'Description',
                'price' => 1500,
            ],
            [
                'name' => 'Nokia',
                'description' => 'Description',
                'price' => 4000,
            ],
            [
                'name' => 'xiaomi',
                'description' => 'Description',
                'price' => 1200,
            ],
            [
                'name' => 'Sony',
                'description' => 'Description',
                'price' => 200,
            ],
        ]);
    }
}
