<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Following;
class FollowingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
// 省略

public function run()
{
    $following_data = [
        ['user_id' => 1, 'following_user_id' => 3],
        ['user_id' => 2, 'following_user_id' => 3],
        ['user_id' => 3, 'following_user_id' => 1],
    ];

    foreach($following_data as $following_values) {

        $following = new Following;
        $following->user_id = $following_values['user_id'];
        $following->following_user_id = $following_values['following_user_id'];
        $following->save();

    }
}

// 省略
}