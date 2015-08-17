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
        Route::group(['prefix'=>'categories'], function(){

            Route::get('', array('as' => 'categories', 'uses' => 'AdminCategoriesController@index'));
            Route::get('create', array('as' => 'categories.create', 'uses' => 'AdminCategoriesController@create'));
            Route::post('', array('as' => 'categories.post', 'uses' => 'AdminCategoriesController@store'));
            Route::get('{category}', array('as' => 'categories.show', 'uses' => 'AdminCategoriesController@show'));
            Route::get('{id}/edit', array('as' => 'categories.edit', 'uses' => 'AdminCategoriesController@edit'));
            Route::post('{id}/update', array('as' => 'categories.update','uses' => 'AdminCategoriesController@update'));
            Route::get('{id}/destroy', array('as' => 'categories.destroy', 'uses' => 'AdminCategoriesController@destroy'));
        });


        Route::group(['prefix'=>'products'], function(){

            Route::get('', array('as' => 'products','uses'=> 'AdminProductsController@index'));
            Route::get('create', array('as' => 'products.create','uses' => 'AdminProductsController@create'));
            Route::post('', array('as' => 'products.store', 'uses' => 'AdminProductsController@store'));
            Route::get('{product}', array('as' => 'products.show', 'uses' => 'AdminProductsController@show') );
            Route::get('{id}/edit', array('as' => 'products.edit', 'uses' => 'AdminProductsController@edit'));
            Route::post('{id}/update', array('as' => 'products.update', 'uses' => 'AdminProductsController@update'));
            Route::get('{id}/destroy', array('as' => 'products.destroy', 'uses' =>'AdminProductsController@destroy'));

            Route::group(['prefix'=>'images'], function(){

                Route::get( '{id}/product', ['as'=>'products.images','uses'=>'AdminProductsController@images']);
                Route::get( 'create/{id}/product', ['as'=>'products.images.create','uses'=>'AdminProductsController@createImage']);
                Route::post( 'store/{id}/product', ['as'=>'products.images.store','uses'=>'AdminProductsController@storeImage']);
                Route::get( 'destroy/{id}/image', ['as'=>'products.images.destroy','uses'=>'AdminProductsController@destroyImage']);

            });

    });



    });

Route::get
    ('/', function ()
        {
            return view('welcome');
        });
