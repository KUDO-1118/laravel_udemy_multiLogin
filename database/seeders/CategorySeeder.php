<?php

namespace Database\Seeders;

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
        DB::table('primary_categories')->insert([
            [
                'name' => 'ゲーム',
                'sort_order' => 1
            ],
            [
                'name' => 'ホビー',
                'sort_order' => 2
            ],
            [
                'name' => 'スマホ',
                'sort_order' => 3,
            ]
        ]);

        DB::table('secondary_categories')->insert([
            [
                'name' => 'ゲームソフト',
                'sort_order' => 1,
                'primary_category_id' => 1
            ],
            [
                'name' => '本体機器',
                'sort_order' => 2,
                'primary_category_id' => 1
            ],
            [
                'name' => '周辺機器',
                'sort_order' => 3,
                'primary_category_id' => 1
            ],
            [
                'name' => 'おもちゃ',
                'sort_order' => 4,
                'primary_category_id' => 2
            ],
            [
                'name' => 'ボードゲーム',
                'sort_order' => 5,
                'primary_category_id' => 2
            ],
            [
                'name' => '0歳〜3歳向け',
                'sort_order' => 6,
                'primary_category_id' => 3
            ],
        ]);
    }
}
