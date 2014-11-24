<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validator
	|--------------------------------------------------------------------------
	|
	|	Identification
	|
	*/

	'login'			=>		array(	'email'		=> 'required|email|max:225',
									'password'	=> 'required|max:225'),


	'forgot'		=>		array(	'email'		=> 'required|email|max:225'),


	/*
	|	Commentaire
	|
	*/
	
	'comment'		=>		array(	'name'		=> 'required|min:3',
									'email'		=> 'required|min:3|email',
									'comment'	=> 'required|min:3'),

	'comment-admin'	=>		array(	'comment'	=> 'required|min:3'),


	'post'			=> 		array(	'title'		=> 'required|min:3',
									'content'	=> 'required|min:3',
									'image'		=> 'image'),

	'slider'		=> 		array(	'image'		=> 'required|image',
									'img_alt'	=> 'required|min:3',
									'description'=> 'min:3'),


	'slider-edit'	=> 		array(	'image'		=> 'image',
									'img_alt'	=> 'required|min:3',
									'description'=> 'min:3'),

	/*
	|	Admin
	|
	|	Environment
	|
	*/
	'admin'			=>		array(	
		'languages'		=>		array(	'id'		=> 'min:2|max:15'),


	/*
	|	Option
	|
	| Only regular (-i18n) rules
	*/
		'option'		=> 		array(	'site_url'		=> 'url|min:5',										
										'admin_email'	=> 'email|min:5|max:55'),
		
		'option_site_name'=>	array(  'site_name'		=> 'min:5'),
	

	/*
	|	Role / Permission
	|
	*/
		'role'		=> 		array(	'name'			=> 'required|min:3|max:200'),

		'permission'=> 		array(	'resource_id'	=> 'exists:resources,id',
									'role_id'		=> 'required|exists:roles,id'),
		
	/*
	|	Tag
	|
	*/
		'tag'		=> 		array(	'name'			=> 'required|min:2|max:200'),
		
	/*
	|	Navigation
	|
	*/
		'navigation'			=> 		array(	'model_resource_id'	=> 'min:2|max:55',
												'url_external'		=> 'min:1|max:255',
												'parent_id'			=> 'exists:navigations,id'),


		'navigation_title'		=> 		array(	'title'			=> 'required|min:2|max:55'),
		
	/*
	|	Auth
	|
	*/
		'auth_role'	=> 		array ( 'role'		=> 'required|exists:roles,id'),

		'auth_profil'=>		array(	'oldpassword'=> 'required',
									'password'	=> 'required|max:225'),

	/*
	|	User
	|
	
		'user_create'=>		array(	'pseudo'	=> 'required|max:45',
									'firstname'	=> 'required|max:45',
									'lastname'	=> 'required|max:45',
									'email'		=> 'required|email|max:225',
									'password'	=> 'required|max:225'),

		'user_role'	=> 		array ( 'role'		=> 'required|exists:roles,id'),

		'user_profil'=>		array(	'pseudo'	=> 'required|max:45',
									'firstname'	=> 'required|max:45',
									'lastname'	=> 'required|max:45',
									'email'		=> 'required|email|max:225',
									'oldpassword'=> 'required',
									'password'	=> 'required|max:225'),

	*/
		
	),

);