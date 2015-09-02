<?php

namespace Dynamix\Providers;

use Illuminate\Support\ServiceProvider;

use View;

use Dynamix\Models\Theme;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::addNamespace('theme', [
            base_path().'/theme/' . Theme::getThemeName() . '/views',
            base_path().'/theme/default/views'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Register The Modules Providers
        |--------------------------------------------------------------------------
        |
        |
        */
        foreach (config('module') as $module) {
            App::register('Dynamix\\' . $module . '\\' . $module . 'ServiceProvider');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
