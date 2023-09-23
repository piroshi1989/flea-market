<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Sale;
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Sale::class;

    public function definition()
    {
        $address = $this->faker->prefecture . $this->faker->city . $this->faker->streetAddress;
        //addressはxx県xx市xxで自動生成

        $paymentMethodId = $this->faker->numberBetween(1, 3);
        if($paymentMethodId === 1){
            $paymentCode = $this->faker->unique()->numberBetween(100000000, 999999999);
        }else{
            $paymentCode = null;
        }

        return [
            'user_id' => $this->faker->numberBetween(1,5),
            'item_id' => $this->faker->unique()->numberBetween(1,30),
            'payment_amount' => $this->faker->numberBetween(400,5000),
            'payment_method_id' => $paymentMethodId,
            'postcode' => $this->faker->numerify('###-####'),
            'address' => $address,
            'building_name' => $this->faker->secondaryAddress(),
            'payment_code' => $paymentCode,
        ];
    }
}