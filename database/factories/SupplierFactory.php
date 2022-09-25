<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $pics_index = mt_rand(1,30);

        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' =>  $this->faker->numberBetween(1000,100000000),
            'address' => $this->faker->address(),
            'phone_number' => $this->faker->numberBetween(3000000000,3499999999),
            'about' => $this->faker->text(),
            'profile_image' => "FakeImages/profile/{$pics_index}.webp",
            'status' => $this->faker->randomElement(['pending', 'approved']),
            'created_at' => $this->faker->dateTimeBetween('-20 days', '-6 days'),
            'updated_at' => $this->faker->dateTimeBetween('-5 days', '-1 minute')
        ];
    }
}
