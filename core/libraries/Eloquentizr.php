<?php

use Illuminate\Database\Eloquent\Model;
 
class Eloquentizr extends Model {

	// Global data to return in a View
	public $data = array();

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
		 
		$eloquent = \Cache::remember($tableName.':'.$id, static::$expireCache, function() use ($id, $tableName,$instance, $columns){
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
 		if (method_exists(get_called_class(), 'formParams')) {
	 		$data = $this->formParams();
	 		$data['model'] = get_class($this);
	 		return $data;
 		} else {
 			return null;
 		}
 	}

 	public static function generateForm($modelId = null, $params = null)
 	{
 		$model = get_called_class();
 		return \Former::renderByModel(new $model, $modelId, $params);
 	}

 	public static function getNotAllowed () {
        $notAllowed = array();

        //get all Nav with a page as resource
        $navs = Nav::where('navigable_type','=',get_class())->get();
        $allowed = array();
        foreach ( $navs as $nav ) {
            $allowed[] = $nav->navigable->id;
        }

        //get all Pages
        $objects = self::all();

        //store each resources
        foreach ( $objects as  $object ) {
            if ( !in_array( $object->id, $allowed ) ) {
                $notAllowed[] = $object;
            }
        }

        return $notAllowed;
    }

}