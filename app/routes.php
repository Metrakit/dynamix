<?php

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
|
|	Home Page
|
*/
//Index of website
Route::get('/', array('uses' => 'HomeController@index'));




/*
|--------------------------------------------------------------------------
| Migration
|--------------------------------------------------------------------------
|
*/
Route::get('/migrate', function(){
  define('STDIN',fopen("php://stdin","r"));
  Artisan::call("migrate:reset");
  Artisan::call("migrate");
  Artisan::call("db:seed");
  return "migrated";
});




/*
|--------------------------------------------------------------------------
| Element (Category|Post|Page)
|--------------------------------------------------------------------------
|
|	Element (Category|Post|Page)
|
*/
Route::get('{slug}', array('uses' => 'DynamixController@master'));




/*
|--------------------------------------------------------------------------
| Composer before errors
|--------------------------------------------------------------------------
|
|	Composer before errors
|
*/
//Master layout
/*View::composer('errors.*', function ($view)
{
	$view->with( 'isError' , true );
});*/



/*
|--------------------------------------------------------------------------
| Error 404...
|--------------------------------------------------------------------------
|
|
*/
App::missing(function($exception)
{
    return Response::view('errors.404', array(), 404);
});




































/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
|
|	Admin
|
*/
/*Route::group( array('before' => 'auth', 'prefix' => 'admin') , function (){
	//Index / Dashboard
	Route::get('/','AdminController@index');

	//Manage Blog
	//Create, edit, delete Posts
	Route::resource('post','AdminPostController');
	Route::resource('page','AdminPageController',
		array('except' => array('create')) );

	Route::resource('slider','AdminSliderController');

	//Create (with User), edit, delete, return Comments
	Route::get('/','AdminController@index');

	//Manage Register
	Route::resource('register','AdminRegisterController',
		array('only' => array('destroy', 'show')) );

	//Manage Comments
	Route::resource('comment','AdminCommentController',
		array('only' => array('index', 'destroy')) );
	Route::post('comment/{id}/confirm', 'AdminCommentController@confirm');

	//Create, edit, delete Page
	//Route::get('/','AdminController@index');
});
*/

/*
|--------------------------------------------------------------------------
| User
|--------------------------------------------------------------------------
|
|	User
|
*/

//:: User Login Routes ::
//Login
/*Route::get('user/login', 'UserController@login');
Route::post('user/login', 'UserController@post_login');
//Logout
Route::get('user/logout', 'UserController@logout');
//Forgot password
Route::get('user/forgot', 'UserController@forgot');
Route::post('user/forgot', 'UserController@post_forgot');
//:: User (Create, Edit, Remove, etc..) ::
Route::resource('user','UserController',
		array('except' => array('create')) );

*/



/*
|--------------------------------------------------------------------------
| Control
|--------------------------------------------------------------------------
|
|	Control
|
*/
/*Route::get('/control/{id}/{bool}/{sha}','BlogController@getAction');

*/

/*
|--------------------------------------------------------------------------
| Blog
|--------------------------------------------------------------------------
|
|	Blog
|
*/
//Index of blog (actualite)
/*Route::get('{blogName}', array('uses' => 'BlogController@index'));

Route::get('{blogPost}', 'BlogController@getView');
Route::post('{blogPost}', 'BlogController@postView');
*/

//Test
//Route::get('/test', 'StaticController@test');

/*
|--------------------------------------------------------------------------
| Composer
|--------------------------------------------------------------------------
|
|	Composer
|
*/
//View::composer('*', 'MasterComposer');