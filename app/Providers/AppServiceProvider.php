<?php

namespace App\Providers;

use App\Helpers\AuthenticableOdoo;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(AuthenticableOdoo::class, function(){
            return new AuthenticableOdoo();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
