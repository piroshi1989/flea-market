<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'user1',
            'email' => 'a@gmail.com',
            'email_verified_at' =>  now(),
            'password' => Hash::make('password'),
            'role' => 0,
            'image_url' => 'https://source.unsplash.com/random/640x480',
        ]);

        DB::table('users')->insert([
            'name' => 'user2',
            'email' => 'b@gmail.com',
            'email_verified_at' =>  now(),
            'password' => Hash::make('password'),
            'role' => 0,
            'postcode' => '123-1111',
            'address' => '香川県三豊市高瀬町上高瀬786-11',
            'building_name' => '高瀬ビル201',
            'image_url' => 'https://source.unsplash.com/random/640x480',
        ]);


        DB::table('users')->insert([
            'name' => 'user3',
            'email' => 'c@gmail.com',
            'email_verified_at' =>  now(),
            'password' => Hash::make('password'),
            'role' => 0,
            'postcode' => '321-2132',
            'address' => '宮城県仙台市青葉区西勝山759-1',
            'building_name' => '勝山ヒルズ203',
            'image_url' => 'https://source.unsplash.com/random/640x480',
        ]);

        DB::table('users')->insert([
            'name' => 'user4',
            'email' => 'd@gmail.com',
            'email_verified_at' =>  now(),
            'password' => Hash::make('password'),
            'role' => 0,
        ]);

        DB::table('users')->insert([
            'name' => 'user5',
            'email' => 'e@gmail.com',
            'email_verified_at' =>  now(),
            'password' => Hash::make('password'),
            'role' => 0,
        ]);
        
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'f@gmail.com',
            'email_verified_at' =>  now(),
            'password' => Hash::make('password'),
            'role' => 1,
        ]);
    }
}