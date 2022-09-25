<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Order::factory(5000)->create();

        $orders = Order::factory(5000)->make();
        $orders->chunk(500)->each(function($chunk) {
            Order::insert($chunk->toArray());
        });
        

    }
}
