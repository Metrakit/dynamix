<?php

return array(
    
	//Memcache Config
	'DEBUG'				  => false,
	'DOMAIN'              => 'dynam.ix',
	'DRIVER_CACHE'        => 'file',
	'DRIVER_SESSION'      => 'file',

	//App Key
	'KEY'				  => 'Bhvs1QjP1zse2sCwJmWvTndnbg6cjrTT',

	// Database Datas
	'DB_HOST'     => 'localhost',
	'DB_DATABASE' => 'homestead',
	'DB_USERNAME' => 'homestead',
	'DB_PASSWORD' => 'secret',

	// Google Analytics Datas
	'GA_CLIENT_ID' 			=> '246128526605-sv68q5u54cavcgfasda27s8qm4k5skbv.apps.googleusercontent.com',
	'GA_SERVICE_EMAIL' 		=> '246128526605-sv68q5u54cavcgfasda27s8qm4k5skbv@developer.gserviceaccount.com',
	'GA_CERTIFICATE_PATH' 	=> app_path() . '/config/packages/thujohn/analytics/google-analytics-api.p12',
	'GA_USE_OBJECTS' 		=> true,


);