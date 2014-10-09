<?php

use Illuminate\Database\Eloquent\Model;
 
class SteroidEloquent extends Model{
 	/**
	* Cache time in minutes
	* @var int
	*/
	protected static $expireCache = 5;

	/**
	* Get with condition cached eloquent object's
	* @param $field
	* @param $operator
	* @param $value
	* @return Eloquent
	*/
	public static function whereCached($field, $operator, $value)
	{
		$instance = new static;
		$tableName = $instance->getTable();
		 
		$eloquent = Cache::remember($tableName, static::$expireCache, function() use ($field, $operator, $value, $tableName,$instance){
			return $instance->where($field, $operator, $value);
		});
 
 		return $eloquent;
 	} 

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


 	/**
 	 * Get settings of a Formr
 	 * @return Array
 	 * @todo  Modifier le 'view' (éclaircir ce point avec David)
 	 */
 	public function formr()
 	{
 		$className = get_class($this);
 		if (Config::has('forms/gallery' . $className)) {
 			$config = Config::get('forms/' . $className);
 			$config['model'] = $className;
 			return $config; 
 		} else {
 			throw new Exception("Gallery config file for the form is missing", 1); 			
 		}
 	}

}