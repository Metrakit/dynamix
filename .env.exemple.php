<?php

return array(
	'DOMAIN'              => 'dynam.ix',
	'DRIVER_CACHE'        => 'file',//file, memcach
	'DRIVER_SESSION'      => 'file',//file, memcach
	'KEY'				  => 'make php artisan key:generate to get a fucking key to your app',

	// Database Datas
	'DB_HOST'     => 'localhost',
	'DB_DATABASE' => 'homestead',
	'DB_USERNAME' => 'homestead',
	'DB_PASSWORD' => 'secret',

	// Google Analytics Datas
	'GA_CLIENT_ID' 			=> '',
	'GA_SERVICE_EMAIL' 		=> '',
	'GA_CERTIFICATE_PATH' 	=> app_path() . '/config/packages/thujohn/analytics/google-analytics-api.p12',
	'GA_USE_OBJECTS' 		=> true,




	
);
