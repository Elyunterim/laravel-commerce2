<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use LaravelCommerce\User;

class UserTableSeeder extends seeder
{
    public function run()
    {
        DB::table('users')->truncate();

        factory('LaravelCommerce\User')->create([
            'name' => 'Andre',
            'email' => 'andreluiz1013@hotmail.com',
            'password' => Hash::make(123456),
            'is_admin' => 1
        ]);

        factory('LaravelCommerce\User', 10)->create();
    }
}