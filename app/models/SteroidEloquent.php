<?php

use Illuminate\Database\Eloquent\Model;
 
class SteroidEloquent extends Model
{
 	/**
	* Cache time in minutes
	* @var int
	*/
	protected static $expireCache = 5;
 
 	/**
	* Find cached eloquent object
	* @param $id
	* @param $columns
	* @return Eloquent
	*/
	public static function findCached($id, $columns = array('*'))
	{
		$instance = new static;
		$tableName = $instance->getTable();
		 
		$eloquent = Cache::remember($tableName.':'.$id, static::$expireCache, function() use ($id, $tableName,$instance, $columns){
			return $instance->find($id, $columns);
		});
 
 		return $eloquent;
 	}
}