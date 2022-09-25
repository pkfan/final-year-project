<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement(
                ['Smart Phones',
                'Tablets',
                'Laptops',
                'Computer & PCs',
                'Smart TV',
                'Head Phones',
                'Smart Watches',
                'Security Cameras',
                'Printers']
            ),
            'description' => $this->faker->text(250),
            'created_at' => $this->faker->dateTimeBetween('-19 days', '-5 days'),
            'updated_at' => $this->faker->dateTimeBetween('-5 days', '-1 minute')
        ];
    }
}
