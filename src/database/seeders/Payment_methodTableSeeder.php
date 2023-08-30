<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Payment_methodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->insert([
            ['name' => 'コンビニ払い'],
            ['name' => '代引き'],
            ['name' => 'クレジット決済'],
            ]);
    }
}