<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        $supplier_and_shop_id = $this->faker->numberBetween(1,20);

        $product = [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(30),
            'price' => mt_rand(200, 99999),
            'type' => $this->faker->randomElement(
                ['Phone',
                'Tablet',
                'Laptop',
                'Computer',
                'Smart TV',
                'Head Phone',
                'Smart Watch',
                'Security Camera',
                'Printer']
            ),
            'brand' => $this->faker->word(),
            'stars' => $this->faker->randomElement([1.0,2.0,3.0]),
            'ratings' => $this->faker->numberBetween(0,30),
            'orders' => $this->faker->numberBetween(0,30),
            'category_id' => $this->faker->numberBetween(1,9),
            'shop_id' => $supplier_and_shop_id,
            'supplier_id' => $supplier_and_shop_id,
            'created_at' => $this->faker->dateTimeBetween('-19 days', '-5 days'),
            'updated_at' => $this->faker->dateTimeBetween('-5 days', '-1 minute')
        ];

        $status = $this->faker->randomElement(['pending', 'approved', 'cancel']);

        $product['status'] = $status;

        if($status == 'approved' || $status == 'cancel'){
            $product['admin_id'] = 1;
        }


        return $product;
    }
}
