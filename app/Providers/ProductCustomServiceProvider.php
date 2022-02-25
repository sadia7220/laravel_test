<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ProductBuilder;

class ProductCustomServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('App\Services\ProductBuilder', function ($app) {
            return new ProductBuilder();
        });
    }
}
