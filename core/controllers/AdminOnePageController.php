<?php

class AdminOnePageController extends BaseController {

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

		//Check if the connection is ok

		//Google Analytics
		$data['ga_sessionsPerDay'] 			= App::make('GoogleAnalyticsAPIController')->getSessionsPerDay();
		$data['ga_sessionsCount'] 			= App::make('GoogleAnalyticsAPIController')->getSessionsCount();
		$data['ga_userCount'] 				= App::make('GoogleAnalyticsAPIController')->getUserCount();
		$data['ga_pageSeenCount'] 			= App::make('GoogleAnalyticsAPIController')->getPageSeenCount();
		$data['ga_pagesBySession'] 			= round( $data['ga_pageSeenCount'] / $data['ga_sessionsCount'], 2);
		$data['ga_timeBySession'] 			= round( App::make('GoogleAnalyticsAPIController')->getTimeBySession() / $data['ga_sessionsCount'], 0).'s';
		$data['ga_rebound'] 				= App::make('GoogleAnalyticsAPIController')->getRebound();
		$data['ga_newOnReturningVisitor'] 	= App::make('GoogleAnalyticsAPIController')->getNewOnReturningVisitor();

		if (Request::ajax()) {
			return Response::json(View::make('theme::' . 'admin.index', $data )->renderSections());
		} else {
			return View::make('theme::' .'admin.index', $data );
		}
	}
}