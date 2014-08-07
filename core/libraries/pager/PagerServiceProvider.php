<?php

use Illuminate\Support\ServiceProvider;

class PagerServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('pager', function()
        {
            return new \PageGenerator\Pager;
        });
    }

}