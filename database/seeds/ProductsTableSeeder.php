<?php
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('products');//->truncate();

        factory('LaravelCommerce\Product', 10)->create();
    }
}