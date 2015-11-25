<?php

namespace LaravelCommerce\Providers;

use Illuminate\Support\ServiceProvider;
use PHPSC\PagSeguro\Purchases\Subscriptions\Locator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Locator', function(){
           return new Locator($this->app->make('PHPSC\PagSeguro\Credentials'));
        });
    }
}
