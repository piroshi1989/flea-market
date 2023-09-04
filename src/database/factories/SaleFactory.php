<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $address = $this->faker->prefecture . $this->faker->city . $this->faker->streetAddress;
        
        return [
            'user_id' => $this->faker->numberBetween(1,5),
            'item_id' => $this->faker->numberBetween(1,30),
            'payment_amount' => $this->faker->numberBetween(400,5000),
            'payment_method_id' => $this->faker->numberBetween(1,3),
            'shipping_name' => $this->faker->name(),
            'postcode' => $this->faker->numerify('###-####'),
            'address' => $address,
            'building_name' => $this->faker->secondaryAddress(),
        ];
    }
}