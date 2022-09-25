<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductImage>
 */
class ProductImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {   
        $min = 1;
        $max = 70;

        return [
            'image_1' => "FakeImages/product/". strval(mt_rand($min,$max)) . ".png",
            'image_2' => "FakeImages/product/". strval(mt_rand($min,$max)) . ".png",
            'image_3' => "FakeImages/product/". strval(mt_rand($min,$max)) . ".png",
            'image_4' => "FakeImages/product/". strval(mt_rand($min,$max)) . ".png",            
        ];
    }
}
