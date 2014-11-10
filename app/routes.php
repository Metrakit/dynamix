<?php

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
Route::get('/first-migrate', function(){
  define('STDIN',fopen("php://stdin","r"));
  Artisan::call("migrate");
  Artisan::call("db:seed");
  return "migrated";
});


/*
|--------------------------------------------------------------------------
| System
|--------------------------------------------------------------------------
|
*/
//i18n
Route::get('choose-your-language', array ('uses' => 'UserController@choose_your_language'));


/*
|--------------------------------------------------------------------------
| Front
|--------------------------------------------------------------------------
|
|
*/
$locale = Localizr::initLocale();
Route::group(array('prefix' => $locale), function() 
{
	Route::get('/', array('uses' => 'URLManagerController@getHome'));
	Route::get('{slug}', array('uses' => 'URLManagerController@getSlug'));
});



/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
|
|	Admin
|
*/
Route::group( array('before' => 'auth.admin', 'prefix' => 'admin') , function (){
	//Dashboard
	Route::get('/','AdminController@index');

	//Media
	Route::get('/media', array('before' => 'auth.permission_media', 'uses' => 'AdminController@getMedia'));
	
	//Page
	Route::resource('page','AdminPageController',
		array('except' => array('show')) );

	//Tag
	Route::resource('tag','AdminTagController',
		array('except' => array('show')) );

	//Navigation
	Route::resource('navigation','AdminNavigationController',
		array('except' => array('create','store','show')) );
		Route::post('menu/{id}/move','AdminMenuController@move');
		
		Route::get('menu/create-new-menu','AdminMenuController@createNewMenu');
		Route::post('menu/create-new-menu','AdminMenuController@postCreateNewMenu');
		Route::get('menu/create-menu','AdminMenuController@createMenu');
		Route::post('menu/create-menu','AdminMenuController@postCreateMenu');

	//Role / Permission
	Route::get('/role_permission', array('before' => 'auth.permission_role', 'uses' => 'AdminController@getRolePermission'));
		//Role RestFull
		Route::resource('role', 'AdminRoleController',
			array('except' => array('index','show')) );
		//Permission update
		Route::post('/permission', 'AdminController@postPermission');
	
	//User index
	Route::get('/user/profil', 'AdminUserController@showProfil');
	Route::get('/user/profil/edit', 'AdminUserController@editProfil');
	Route::post('/user/profil/edit', 'AdminUserController@updateProfil');
	Route::resource('user', 'AdminUserController',
			array('except' => array('show')) );
	
	//Log
	Route::get('/log', array('before' => 'auth.permission_log', 'uses' => 'AdminController@getLog'));

	//Option
	Route::get('/option', array('before' => 'auth.permission_option', 'uses' => 'AdminController@getOption'));
	Route::post('/option', 'AdminController@postOption');

	//Languages
	Route::get('/environment', array('before' => 'auth.permission_environment', 'uses' => 'AdminController@getEnvironnement'));
	Route::post('/languages', 'AdminController@postLanguages');



	
/*
	//MOSAIQUES
	Route::resource('mosaique','AdminMosaiqueController',
		array('only' => array('index','edit','update')) );

	//GALLERY
	Route::resource('gallery','AdminGalleryController');
	Route::post('gallery/add-image','AdminGalleryController@postAddImage');
	Route::post('gallery/{order}/move','AdminGalleryController@move');

	//ARTICLE
	Route::resource('image','AdminImageController',
		array('only' => array('destroy')) );
*/
});



/*
|--------------------------------------------------------------------------
| User
|--------------------------------------------------------------------------
|
|	User
|
*/
Route::get('user/login', 'UserController@login');
Route::post('user/login', 'UserController@post_login');
Route::get('user/logout', 'UserController@logout');

Route::get('user/remind', 'RemindersController@getRemind');
Route::post('user/remind', 'RemindersController@postRemind');
Route::get('password/reset/{token}', array('uses' => 'RemindersController@getReset','as' => 'password.reset'));
Route::post('password/reset/{token}', array('uses' => 'RemindersController@postReset','as' => 'password.update'));

Route::resource('user','UserController', array('except' => array('index', 'show')) );


/*
|--------------------------------------------------------------------------
| Former
|--------------------------------------------------------------------------
|
*/
Route::post('form', array('as' => 'form', 'uses' => 'FormerController@store'));




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
| Error...
|--------------------------------------------------------------------------
|
|
*/
/*App::error(function($exception, $code)
{
    switch ($code)
    {
        case 403:
            return Response::view('errors.403', array(), 403);

        case 404:
            return Response::view('errors.404', array(), 404);

        case 500:
            return Response::view('errors.500', array(), 500);
    }
});*/



































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