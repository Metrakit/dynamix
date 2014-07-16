<?php

class MasterComposer {

    public function compose($view)
    {
		// !!! DATABASE CACHE !!!
		//Cache Model::Menu
		Cache::forget('DB_Menu');
		Cache::rememberForever('DB_Menu', function()
		{
		    return Menu::where('parent_id','=',0)->orderBy('order','ASC')->get();
		});

		
		//Cache Model::Resource('name')
		Cache::forget('DB_Resource_name');
		Cache::rememberForever('DB_Resource_name', function()
		{
			//Get all data in database
		    $resources = Resource::all();

		    //Preapre data to extract by id
		    $data = array();
		    foreach( $resources as $r )
		    {
		    	$data[$r->id] = $r->name;
		    }

		    return $data;
		});

		
		//Cache Model::Option
		Cache::forget('DB_Option');
		Cache::rememberForever('DB_Option', function()
		{
		    return Option::first();
		});


		//Cache Model::Option
		Cache::forget('DB_Urls');
    	Cache::rememberForever('DB_Urls', function (){
	        return Urls::all();
	    });


		// !!! APP CONFIG !!!
		//Config::set( 'app.timezone', $value );
		//Config::set( 'app.dateformat', $value );
		//Config::set( 'app.timeformat', $value );
    }
}		

