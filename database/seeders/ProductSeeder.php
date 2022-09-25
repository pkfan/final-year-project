<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory(500)
            ->create()
            ->each(function ($product) {
                $product->productImages()->save(ProductImage::factory()->make());
        });



        // $products = Product::factory(4000)->make();
        // $products->chunk(400)->each(function($pr) {
        //     Product::insert($pr->toArray());
        //     print_r($pr->toArray());

        //     // $productImage = ProductImage::factory()->make();
        //     // $product->productImages()->insert($productImage->toArray());
        // });
    }
}
