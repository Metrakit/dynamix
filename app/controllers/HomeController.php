<?php

class HomeController extends BaseController {

	public function index()
    {
        return App::make('URLManagerController')->getHome();
    }
}