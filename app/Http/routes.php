<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\App;

use Dynamix\Core\Controllers\AdminController;
use Dynamix\Core\Controllers\AdminAuthController;
use Dynamix\Core\Controllers\AdminOnePageController;
use Dynamix\Core\Controllers\AdminTagController;
use Dynamix\Core\Controllers\AdminNavigationController;
use Dynamix\Core\Controllers\AdminTasksController;
use Dynamix\Core\Controllers\InputController;
use Dynamix\Core\Controllers\FormerController;
use Dynamix\Core\Controllers\AdminRoleController;
use Dynamix\Core\Controllers\AuthController;
use Dynamix\Core\Controllers\RemindersController;


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
	if (config('core.display.onepage')) {		
		Route::resource('onepage','AdminOnePageController',
			array('except' => array('show')) );
	}
	
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

	// Formr
	Route::resource('form', 'FormerController');
	// Inputs
	Route::resource('input', 'InputController');

	Route::get('/formr/{formId}/input/add', array('as' => 'add-input', 'uses' => 'InputController@add'));
	Route::get('/formr/{formId}/input/{inputId}/{move}', array('as' => 'move-input', 'uses' => 'InputController@move'));

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

Route::get('login', array('as' => 'public.login', 'uses' => '\Dynamix\Core\Controllers\AuthController@publicLogin'));
Route::post('login', array('as' => 'public.login.post', 'uses' => '\Dynamix\Core\Controllers\AuthController@postPublicLogin'));

Route::get('logout', array('as' => 'logout', 'uses' => '\Dynamix\Core\Controllers\AuthController@logout'));
Route::get('remind', array('as' => 'reminder', 'uses' => '\Dynamix\Core\Controllers\RemindersController@getRemind'));
Route::post('remind', 'RemindersController@postRemind');
Route::get('password/reset/{token}', array('uses' => '\Dynamix\Core\Controllers\RemindersController@getReset','as' => 'password.reset'));
Route::post('password/reset/{token}', array('uses' => '\Dynamix\Core\Controllers\RemindersController@postReset','as' => 'password.update'));

/*
|--------------------------------------------------------------------------
| Former
|--------------------------------------------------------------------------
|
*/
Route::post('formr/{modelId?}', array('as' => 'formr', 'uses' => '\Dynamix\Core\Controllers\FormerController@storeResult'));