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
	Artisan::call("migrate", ['--quiet' => true, '--force' => true]);
	Artisan::call("db:seed");
	return "migrated";
});
Route::get('/first-migrate', function(){
	define('STDIN',fopen("php://stdin","r"));
	Artisan::call("migrate", ['--quiet' => true, '--force' => true]);
	Artisan::call("db:seed");
	return "migrated";
});

Route::get('/composer-update', function(){
	define('STDIN',fopen("php://stdin","r"));
	exec('composer update');
	return "updated";
});

Route::get('/dump-autoload', function(){
	define('STDIN',fopen("php://stdin","r"));
	Artisan::call("dump-autoload");
	return "dumpé!";
});




/*
|--------------------------------------------------------------------------
| Base/System
|--------------------------------------------------------------------------
|
*/
//i18n
Route::get('choose-your-language', array ('uses' => 'BaseController@choose_your_language'));
/*
|--------------------------------------------------------------------------
| Front
|--------------------------------------------------------------------------
|
|
*/

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
	Route::get('/',array('as'=> 'index_admin', 'uses' => 'AdminController@index'));
		// Task
		Route::resource('task', 'AdminTasksController');

	//Auth 
	Route::get('auth', 'AdminAuthController@index');
	Route::get('profil', 'AdminAuthController@showProfil');
	Route::get('profil/edit', 'AdminAuthController@editProfil');
	Route::post('profil/edit', 'AdminAuthController@updateProfil');
	Route::get('role/{id}/edit', 'AdminAuthController@editRole');
	Route::post('role/{id}', 'AdminAuthController@updateRole');
	//Media
	Route::get('/media', array('before' => 'auth.permission_media', 'uses' => 'AdminController@getMedia'));
	
	//OnePage
	if (Config::get('theme::core::display.onepage')) {		
		Route::resource('onepage','AdminOnePageController',
			array('except' => array('show')) );
	}

	//Page
	Route::resource('page','AdminPageController');
		//API - AJAX
		Route::get('/page/block-type/{name}', 'AdminBlockTypeController@getBlockType');
		Route::post('/page/block/{template}', 'AdminPageController@getBlockTemplate');
		Route::post('/page-block', 'AdminPageController@store_block');
	
	//Tag
	Route::resource('tag','AdminTagController',
		array('except' => array('show')) );
	
	//Navigation
	Route::resource('navigation','AdminNavigationController',
		array('except' => array('show')) );
	Route::post('navigation/{id}/move','AdminNavigationController@move');
	Route::get( 'navigation/create-choose','AdminNavigationController@createChoose');
	
	//Role / Permission
		Route::get('/role_permission', array('before' => 'auth.permission_role', 'uses' => 'AdminController@getRolePermission'));
		//Role RestFull
		Route::resource('role', 'AdminRoleController',
			array('except' => array('index','show')) );
		//Permission update
		Route::post('/permission', 'AdminController@postPermission');
		
	//Log
		Route::get('/log', array('before' => 'auth.permission_log', 'uses' => 'AdminController@getLog'));
	
	//Option
		Route::get('/option', array('before' => 'auth.permission_option', 'uses' => 'AdminController@getOption'));
		Route::post('/option', 'AdminController@postOption');

	//Reroute
		Route::get('/rerouter', array('uses' => 'AdminController@getRerouter'));
		Route::post('/rerouter', 'AdminController@postReroute');

	//I18nConstant
		Route::get('/i18n-constant', 'AdminController@getI18nConstant');
		Route::post('/i18n-constant', 'AdminController@postI18nConstant');
	
	//Languages
		Route::get('/environment', array('before' => 'auth.permission_environment', 'uses' => 'AdminController@getEnvironnement'));
		Route::post('/languages', 'AdminController@postLanguages');
	



	// Formr
	Route::resource('form', 'FormerController');
	// Inputs
	Route::resource('input', 'InputController');

	Route::get('/formr/{formId}/input/add', array('as' => 'add-input', 'uses' => 'InputController@add'));
	Route::get('/formr/{formId}/input/{inputId}/{move}', array('as' => 'move-input', 'uses' => 'InputController@move'));
	//Route::get('/form/{formId}/create-input', array('as'=>'create-input', 'uses'=>'InputController@create'));


	// Clear route
	Route::get('/clearcache', array('as' => 'admin-clearcache', 'uses' => 'AdminController@clearcache'));
});

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
|
|	Auth
|
*/
Route::group(array('prefix' => 'admin'), function() 
{
	Route::get('login', array('as' => 'admin.login', 'uses' => 'AuthController@adminLogin'));
	Route::post('login', array('as' => 'admin.login.post', 'uses' => 'AuthController@postAdminLogin'));
});

Route::get('login', array('as' => 'public.login', 'uses' => 'AuthController@publicLogin'));
Route::post('login', array('as' => 'public.login.post', 'uses' => 'AuthController@postPublicLogin'));

Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@logout'));
Route::get('remind', array('as' => 'reminder', 'uses' => 'RemindersController@getRemind'));
Route::post('remind', 'RemindersController@postRemind');
Route::get('password/reset/{token}', array('uses' => 'RemindersController@getReset','as' => 'password.reset'));
Route::post('password/reset/{token}', array('uses' => 'RemindersController@postReset','as' => 'password.update'));

/*
|--------------------------------------------------------------------------
| Former
|--------------------------------------------------------------------------
|
*/
Route::post('formr/{modelId?}', array('as' => 'formr', 'uses' => 'FormerController@storeResult'));

/*
|--------------------------------------------------------------------------
| Comment
|--------------------------------------------------------------------------
|
*/
Route::post('comment', array('as' => 'comment', 'uses' => 'CommentController@store'));
Route::resource('comment','CommentController', array('only' => array('destroy','update')) );
Route::post('comment/{id}/vote/{bool}', array('as' => 'comment-vote', 'uses' => 'CommentController@vote'));





/*
|--------------------------------------------------------------------------
| Router in the end
|--------------------------------------------------------------------------
|
|
*/
$locale = Localizr::initLocale();
Route::group(array('prefix' => $locale), function() 
{
	Route::get('/', array('as' => 'home', 'uses' => Config::get('core::route.root')));
	Route::get('{slug}', array('uses' => 'URLManagerController@getSlug'));
});


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