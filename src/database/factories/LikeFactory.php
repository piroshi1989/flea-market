<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Like;
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Like::class;
    
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1,5),
            'item_id' => $this->faker->numberBetween(1,30),
        ];
    }
}