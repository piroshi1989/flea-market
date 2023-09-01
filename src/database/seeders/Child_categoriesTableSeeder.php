<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Child_categoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('child_categories')->insert([
            'category_id' => 1,
            'name' => '洋服',
        ]);

        DB::table('child_categories')->insert([
            'category_id' => 1,
            'name' => '靴',
        ]);

        DB::table('child_categories')->insert([
            'category_id' => 1,
            'name' => 'バッグ',
        ]);
        
        DB::table('child_categories')->insert([
            'category_id' => 2,
            'name' => '洋服',
        ]);

        DB::table('child_categories')->insert([
            'category_id' => 2,
            'name' => '靴',
        ]);

        DB::table('child_categories')->insert([
            'category_id' => 2,
            'name' => 'バッグ',
        ]);

        DB::table('child_categories')->insert([
            'category_id' => 3,
            'name' => '洋服',
        ]);

        DB::table('child_categories')->insert([
            'category_id' => 3,
            'name' => '靴',
        ]);

        DB::table('child_categories')->insert([
            'category_id' => 3,
            'name' => 'おもちゃ',
        ]);

        DB::table('child_categories')->insert([
            'category_id' => 4,
            'name' => 'キッチン',
        ]);

        DB::table('child_categories')->insert([
            'category_id' => 4,
            'name' => '家具',
        ]);

        DB::table('child_categories')->insert([
            'category_id' => 4,
            'name' => 'インテリア小物',
        ]);

        DB::table('child_categories')->insert([
            'category_id' => 5,
            'name' => '本',
        ]);

        DB::table('child_categories')->insert([
            'category_id' => 5,
            'name' => '音楽',
        ]);

        DB::table('child_categories')->insert([
            'category_id' => 5,
            'name' => 'ゲーム',
        ]);

        DB::table('child_categories')->insert([
            'category_id' => 6,
            'name' => 'コスメ',
        ]);

        DB::table('child_categories')->insert([
            'category_id' => 6,
            'name' => '香水',
        ]);

        DB::table('child_categories')->insert([
            'category_id' => 6,
            'name' => '美容',
        ]);

        DB::table('child_categories')->insert([
            'category_id' => 7,
            'name' => '家電',
        ]);

        DB::table('child_categories')->insert([
            'category_id' => 7,
            'name' => 'スマホ',
        ]);

        DB::table('child_categories')->insert([
            'category_id' => 7,
            'name' => 'カメラ',
        ]);

        DB::table('child_categories')->insert([
            'category_id' => 8,
            'name' => 'スポーツ',
        ]);

        DB::table('child_categories')->insert([
            'category_id' => 8,
            'name' => 'レジャー',
        ]);
    }
}