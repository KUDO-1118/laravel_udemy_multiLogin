<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_stocks')->insert([
            [
                'product_id' => 1,
                'type' => 1,
                'quantity' => 1
            ],
            [
                'product_id' => 1,
                'type' => 1,
                'quantity' => 5
            ],
            [
                'product_id' => 1,
                'type' => 1,
                'quantity' => 10
            ],
            [
                'product_id' => 1,
                'type' => 1,
                'quantity' => 33
            ],
            [
                'product_id' => 1,
                'type' => 1,
                'quantity' => 32
            ],
        ]);
    }
}
