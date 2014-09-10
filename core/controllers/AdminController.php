<?php

class AdminController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//User
		$data['user'] = Auth::user();
		//Interface
		$data['noAriane'] = true;

		//Google Analytics
		$data['ga_sessionsPerDay'] 			= App::make('GoogleAnalyticsAPIController')->getSessionsPerDay();
		
		$data['ga_sessionsCount'] 			= App::make('GoogleAnalyticsAPIController')->getSessionsCount();
		$data['ga_userCount'] 				= App::make('GoogleAnalyticsAPIController')->getUserCount();
		$data['ga_pageSeenCount'] 			= App::make('GoogleAnalyticsAPIController')->getPageSeenCount();
		$data['ga_pagesBySession'] 			= round( $data['ga_pageSeenCount'] / $data['ga_sessionsCount'], 2);
		$data['ga_timeBySession'] 			= round( App::make('GoogleAnalyticsAPIController')->getTimeBySession() / $data['ga_sessionsCount'], 0).'s';
		$data['ga_rebound'] 				= App::make('GoogleAnalyticsAPIController')->getRebound();
		
		$data['ga_newOnReturningVisitor'] 	= App::make('GoogleAnalyticsAPIController')->getNewOnReturningVisitor();

		return View::make('admin.index', $data );
	}

	/**
	 * get All User in base
	 *
	 * @return Response
	 */
	public function getUser()
	{
		$users = User::all();

		return View::make('admin.user.index', compact('users'));
	}

	/**
	 * get All User in base
	 *
	 * @return Response
	 */
	public function getMosaiques()
	{
		$mosaiques = Mosaique::all();

		return View::make('admin.mosaique.index', compact('mosaiques'));
	}


	/**
	 * get the Filemanager
	 *
	 * @return Response
	 */
	public function getMedia()
	{
		//User
		$user = Auth::user();
		//Interface
		$noAriane = true;

		return View::make('admin.media.index', compact('user','noAriane'));
	}


	/**
	 * get All Option in base
	 *
	 * @return Response
	 */
	public function getOption()
	{
		$option = Option::first();

		return View::make('admin.option.index', compact('option'));
	}

	/**
	 * post All Option in base
	 *
	 * @return Response
	 */
	public function postOption()
	{
		// Validate the inputs
        $validator = Validator::make(Input::all(), Config::get('validator.admin.option'));

        
        // Check if the form validates with success
        if ($validator->passes())
        {
        	$option = Option::first();

        	$option->site_url		= Input::get('site_url');
        	$option->site_name		= Input::get('site_name');
        	$option->admin_email	= Input::get('admin_email');
        	$option->analytics		= Input::get('analytics');

        	//if no error when save
        	if($option->save()){
        		Cache::forget('DB_Option');
        		
            	return Redirect::to('admin/option')->with( 'success', 'Les réglages ont été enregistré avec succès !' );
        	}
	        else
	        {
	        	return Redirect::to('admin/option')->with( 'error', 'Ouuups !!! Les réglages n\'ont pas été enregistré !' );
	        }

	    }
	    
		// Show the page
		return Redirect::to('/admin/option')->withInput()->withErrors($validator);
	}
}