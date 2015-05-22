<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log_path = base_path() . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR;

$sql_log = new Logger('SQL Logs');
$sql_log->pushHandler(new StreamHandler($log_path . 'mysql.log', Logger::INFO));

$sql_log->addInfo("===================================================================================================");

DB::listen(function($query, $bindings, $time) use($sql_log) {

	$query = str_replace(array('%', '?'), array('%%', '%s'), $query);
	$query = vsprintf($query, $bindings);
	$sql_log->addInfo($query);
	$sql_log->addInfo('Request executed in ' . $time . ' milliseconds.');
	
});