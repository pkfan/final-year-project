<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_comment' => $this->faker->text(mt_rand(20,1000)),
            'product_rating' => $this->faker->numberBetween(2,5),
            'added_on' => $this->faker->dateTimeBetween('-18 days', '-1 days'),
            'buyer_id' => mt_rand(1,200),
            'product_id' => mt_rand(1,400),
        ];
    }
}
