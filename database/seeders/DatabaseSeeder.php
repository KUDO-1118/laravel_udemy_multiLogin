<?php

namespace Database\Seeders;

use App\Models\Owner;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            OwnerSeeder::class,
            ShopSeeder::class,
            ImageSeeder::class,
            CategorySeeder::class,
            // ProductSeeder::class,
            // StockSeeder::class,
            UserSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();

        Product::factory(100)->create();
        Stock::factory(100)->create();
    }
}

//シードファイルの呼び出し
