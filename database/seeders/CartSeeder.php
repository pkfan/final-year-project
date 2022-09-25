<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cart::factory(1500)->create();

        $carts = Cart::factory(1500)->make();
        $carts->chunk(500)->each(function($chunk) {
            Cart::insert($chunk->toArray());
        });

    }
}
