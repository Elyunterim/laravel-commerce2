<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use LaravelCommerce\Category;


class CategoryTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('categories');//->truncate();

       factory('LaravelCommerce\Category', 10)->create();
    }
}