<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'レディース'],
            ['name' => 'メンズ'],
            ['name' => 'ベビー・キッズ'],
            ['name' => 'インテリア・住まい・小物'],
            ['name' => '本・音楽・ゲーム'],
            ['name' => 'コスメ・香水・美容'],
            ['name' => '家電・スマホ・カメラ'],
            ['name' => 'その他'],
            ]);
    }
}