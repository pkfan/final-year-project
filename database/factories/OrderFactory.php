<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            'shipping_address' => $this->faker->address(),
            'description' => $this->faker->text(1000),
            'order_date' => $this->faker->dateTimeBetween('-10 days', '-1 days'),
            'quantity' => $this->faker->numberBetween(1,3),
            'status' => $this->faker->randomElement( ['pending', 'processing', 'completed', 'cancelByBuyer', 'cancelBySupplier']),
            'buyer_id' => mt_rand(1,200),
            'product_id' => mt_rand(1,400),
        ];
    }
}
