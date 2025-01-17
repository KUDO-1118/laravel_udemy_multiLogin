<?php

namespace Database\Seeders;

use App\Models\Owner;
use App\Models\Product;
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
            ProductSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();
    }
}

//シードファイルの呼び出し
