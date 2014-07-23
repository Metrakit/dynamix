<?php

use Illuminate\Support\Facades\Facade;

class Pager extends Facade {

    protected static function getFacadeAccessor() { return 'pager'; }

}