<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Database\Seeders\CartSeeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\BuyerSeeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\CommentSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\SupplierSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(BuyerSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(ProductSeeder::class);

        $this->call(OrderSeeder::class);
        $this->call(CartSeeder::class);
        $this->call(CommentSeeder::class);


    }
}
