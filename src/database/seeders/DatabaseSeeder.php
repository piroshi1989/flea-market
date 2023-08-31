<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ConditionsTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(LikesTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(Payment_methodsTableSeeder::class);
        $this->call(SalesTableSeeder::class);
    }
}