<?php

namespace App\Providers;

use App;
use Illuminate\Support\ServiceProvider;

class GlpServiceProvider extends ServiceProvider
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
        App::bind('glp', function(){
            return new \App\Glp;
        });
    }
}
