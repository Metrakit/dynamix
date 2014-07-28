<?php

class CacheController extends Controller {

	public function initCache()
	{

		// !!! DATABASE CACHE !!!
		//Cache Model::Menu
		//Cache::forget('DB_Menu');
		/*Cache::rememberForever('DB_Menu', function()
		{
		    return Menu::where('parent_id','=',0)->orderBy('order','ASC')->get();
		});*/

		
		//Cache Model::Resource('name')
		//Cache::forget('DB_Resource_name');
		/*Cache::rememberForever('DB_Resource_name', function()
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
		});*/

		//Cache Model::Mosaique('name')
		//Cache::forget('DB_Mosaique');
		/*Cache::rememberForever('DB_Mosaique', function()
		{
			//Get all data in database
		    return Mosaique::all();
		});*/

		
		//Cache Model::Option
		Cache::rememberForever('DB_Option', function()
		{
		    return Option::first();
		});

		//Cache Model::Urls
		Cache::rememberForever('DB_Urls', function()
		{
		    $data = DB::select('
		    	SELECT translations.i18n_id , translations.text 
				FROM translations
				INNER JOIN i18n_types ON i18n_types.name = ?
				INNER JOIN i18n ON i18n.i18n_type_id = i18n_types.id AND translations.i18n_id = i18n.id
		    ', array('url'));

		    //$data = Translation::i18n()->where('i18n_type_id','=',I18nType::where('name','=','url')->first()->id)->get

		    $datas = array();
		    foreach( $data as $d )
		    {	
		    	$datas[] = array( 'i18n_id' 	=> $d->i18n_id,
		    					  'url'			=> $d->text );
		    }

		    return $datas;
		});
	}

	public function getCache( $cache )
	{
		Cache::forget('DB_Urls');
		Cache::forget('DB_Option');

		if(!Cache::has($cache)){
			App::make('CacheController')->initCache();
		}
		return Cache::get($cache);
	}
}