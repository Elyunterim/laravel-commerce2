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
        Route::get('categories/create', array('as' => 'categoriesCreate', 'uses' => 'AdminCategoriesController@create'));
        Route::post('categories', array('as' => 'categoriesPost', 'uses' => 'AdminCategoriesController@store'));
        Route::get('categories/{category}', array('as' => 'categoriesShow', 'uses' => 'AdminCategoriesController@show'));
        Route::get('categories/{id}/edit', array('as' => 'categoriesEdit', 'uses' => 'AdminCategoriesController@edit'));
        Route::put('categories/{id}', array('as' => 'categoriesUpdate','uses' => 'AdminCategoriesController@update'));
        Route::delete('categories/{id}', array('as' => 'categoriesDel', 'uses' => 'AdminCategoriesController@destroy'));

        Route::get('products', array('as' => 'products','uses'=> 'AdminProductsController@index'));
        Route::get('products/create', array('as' => 'productsCreate','uses' => 'AdminProductsController@create'));
        Route::post('products', array('as' => 'productStore', 'uses' => 'AdminProductsController@store'));
        Route::get('products/{product}', array('as' => 'productShow', 'uses' => 'AdminProductsController@show') );
        Route::get('products/{id}/edit', array('as' => 'productEdit', 'uses' => 'AdminProductsController@edit'));
        Route::put('products/{id}', array('as' => 'productPut', 'uses' => 'AdminProductsController@update'));
        Route::delete('products/{id}', array('as' => 'productDel', 'uses' =>'AdminProductsController@destroy'));

    });

Route::get
    ('/', function ()
        {
            return view('welcome');
        });
