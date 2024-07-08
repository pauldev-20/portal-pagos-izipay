<?php

namespace App\Providers;

use App\Helpers\AuthenticableOdoo;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->singleton(AuthenticableOdoo::class, function(){
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
        if (env('APP_ENV') === 'local') {
            URL::forceRootUrl(Config::get('app.url'));
        }
        if (Str::contains(Config::get('app.url'), 'https://')) {
            URL::forceScheme('https');
        }
    }
}
