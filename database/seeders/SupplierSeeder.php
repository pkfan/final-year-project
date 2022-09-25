<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Supplier::factory(20)
            ->create()
            ->each(function ($supplier) {

                $shop = $supplier->shop()->save(Shop::factory()->make());

                // $products = $shop->products()->saveMany(Product::factory(20)->make());

                // foreach($products as $product){
                //     $product->productImages()->save(ProductImage::factory()->make());
                // }
        });

    }
}
