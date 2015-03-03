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
		 
		$eloquent = \Cache::remember($tableName.':'.$id, static::$expireCache, function() use ($id, $tableName, $instance, $columns){
			return $instance->find($id, $columns);
		});
 
 		return $eloquent;
 	}

	public static function allCached()
	{
		$instance = new static;
		$tableName = $instance->getTable();
		 
		$eloquent = \Cache::remember($tableName.'_all', static::$expireCache, function() use ($tableName, $instance){
			return $instance->all();
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

	public static function getTranslation($i18n_id, $locale_id = null)
 	{
 		$locale_id = ($locale_id===null?App::getLocale():$locale_id);
 		return Translation::where('i18n_id','=',$i18n_id)->where('locale_id','=',$locale_id)->first()->text;
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