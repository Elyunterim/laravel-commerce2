<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');
Route::get('exemplo', 'WelcomeController@exemplo');

Route::group(['prefix'=>'admin'], function()

    {
        Route::get('categories', array('as' => 'categories', 'uses' => 'AdminCategoriesController@index'));
        Route::get('categories/create', array('as' => 'categories.create', 'uses' => 'AdminCategoriesController@create'));
        Route::post('categories', array('as' => 'categories.post', 'uses' => 'AdminCategoriesController@store'));
        Route::get('categories/{category}', array('as' => 'categories.show', 'uses' => 'AdminCategoriesController@show'));
        Route::get('categories/{id}/edit', array('as' => 'categories.edit', 'uses' => 'AdminCategoriesController@edit'));
        Route::post('categories/{id}/update', array('as' => 'categories.update','uses' => 'AdminCategoriesController@update'));
        Route::get('categories/{id}/destroy', array('as' => 'categories.destroy', 'uses' => 'AdminCategoriesController@destroy'));

        Route::get('products', array('as' => 'products','uses'=> 'AdminProductsController@index'));
        Route::get('products/create', array('as' => 'products.create','uses' => 'AdminProductsController@create'));
        Route::post('products', array('as' => 'products.store', 'uses' => 'AdminProductsController@store'));
        Route::get('products/{product}', array('as' => 'products.show', 'uses' => 'AdminProductsController@show') );
        Route::get('products/{id}/edit', array('as' => 'products.edit', 'uses' => 'AdminProductsController@edit'));
        Route::post('products/{id}/update', array('as' => 'products.update', 'uses' => 'AdminProductsController@update'));
        Route::get('products/{id}/destroy', array('as' => 'products.destroy', 'uses' =>'AdminProductsController@destroy'));

    });

Route::get
    ('/', function ()
        {
            return view('welcome');
        });
