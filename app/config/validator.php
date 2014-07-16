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

	'register'		=>		array(	'pseudo'	=> 'required|max:45',
									'firstname'	=> 'required|max:45',
									'lastname'	=> 'required|max:45',
									'email'		=> 'required|email|max:225',
									'password'	=> 'required|max:225'),


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
									'description'=> 'min:3')




		);