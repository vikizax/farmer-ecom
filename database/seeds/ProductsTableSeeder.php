<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Product 1',
            'slug' => 'Product-1',
            'price' => rand(212, 122),
            'stock_qnty' => 234,
            'seller_id' => 1,
            'type' => true,
            'description' => 'Lorem  ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!'
        ]);
    }
}
