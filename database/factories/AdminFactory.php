<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'admin@vu.edu.pk',
            'password' => 1234,
            'address' => $this->faker->address(),
            'phone_number' => $this->faker->numberBetween(3000000000,3499999999),
            'about' => $this->faker->text(),
            'profile_image' => 'assets/images/profile_default.png',
            'created_at' => $this->faker->dateTimeBetween('-30 days', '-10 days'),
            'updated_at' => $this->faker->dateTimeBetween('-9 days', '-1 minute')
        ];
    }
}
