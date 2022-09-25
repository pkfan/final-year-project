<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'added_on' => $this->faker->dateTimeBetween('-18 days', '-1 days'),
            'buyer_id' => mt_rand(1,200),
            'product_id' => mt_rand(1,400),
        ];
    }
}
