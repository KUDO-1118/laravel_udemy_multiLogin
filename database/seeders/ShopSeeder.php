<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shops')->insert([
            [
             'owner_id' => 1,
             'name' => 'ここに店名が入る',
             'information' => 'ここに店舗の情報が入る',
             'filename' => 'sample1.jpg',
             'is_selling' => true
            ],
            [
                'owner_id' => 2,
                'name' => 'ここに店名が入る',
                'information' => 'ここに店舗の情報が入る',
                'filename' => 'sample2.jpg',
                'is_selling' => true
               ],
        ]);
    }
}
