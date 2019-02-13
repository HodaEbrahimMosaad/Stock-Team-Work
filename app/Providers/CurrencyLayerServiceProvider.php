<?php

namespace App\Providers;

use \App\Services\CurrencyLayer;
use Illuminate\Support\ServiceProvider;

class CurrencyLayerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(CurrencyLayer::class, function(){
            return new CurrencyLayer(auth()->user()->key());
        });
    }
}
