<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Item::class;

    public function definition()
    {
        $image_url = "https://source.unsplash.com/random/640x480";

        return [
            'name' => $this->faker->word,
            'image_url' => $image_url,
            'price' => $this->faker->numberBetween(300,100000),
            'category_id' => $this->faker->numberBetween(1,13),
            'condition_id' => $this->faker->numberBetween(1,6),
            'user_id' => $this->faker->numberBetween(1,2),
            'detail' => $this->faker->realText(200),
        ];
    }
}