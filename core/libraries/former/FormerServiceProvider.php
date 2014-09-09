<?php

use Illuminate\Support\ServiceProvider;

class FormerServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('former', function($app)
        {
            return new \FormGenerator\Former($app);
        });
    }

}