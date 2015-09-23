<?php
// .env file for production
return array(

	
	
	'DOMAIN'              => 'dynam.ix',
	// Debug
	'DEBUG'		      => false,
	// Cache (file, memcached)
	'DRIVER_CACHE'        => 'memcached',
	// Cache (file, memcached)
	'DRIVER_SESSION'      => 'memcached',
	//App key ! php artisan key:generate
	'KEY'		      => 'Bhvs1QjP1zse2sCwJmWvTndnbg6cjrTT',
	
	
	// Database Datas
	'DB_HOST'             => 'localhost',
	'DB_DATABASE'         => 'dynamix',
	'DB_USERNAME'         => 'root',
	'DB_PASSWORD'         => 'secret',
	
	// Google Analytics Datas
	'GA_CLIENT_ID'        => '',
	'GA_SERVICE_EMAIL'    => '',
	'GA_CERTIFICATE_PATH' => app_path() . '/config/packages/thujohn/analytics/google-analytics-api.p12',
	'GA_USE_OBJECTS'      => true,


);
