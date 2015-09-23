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
 	 */
 	public function formr($combine)
 	{
 		if (method_exists(get_called_class(), 'formParams')) {
	 		$data = $this->formParams();
	 		$data['model'] = get_class($this);

	 		if ($combine && isset($data['combine']) && is_array($data['combine'])) {

				$data['data']['combine_form'] = array(
                    'name'        => 'combine_form',
                    'type'        => 'hidden',
                    'rules'       => 'required',
                    'value'       => true,
                    'viewPath'    => 'public.form.input.hidden'
                );

	 			foreach ($data['combine'] as $model_name) {
	 				$form_model = $model_name::formParams();
	 				$inputs = $form_model['data'];
	 			
 					if (isset($inputs['send'])) {
 						unset($inputs['send']);
 					}

	 				$data['data'] = array_merge($inputs, $data['data']);
	 			}
	 		}

	 		return $data;
 		} else {
 			return null;
 		}
 	}

 	public static function generateForm($modelId = null, $params = null, $combine = false)
 	{
 		$model = get_called_class();
 		return \Former::renderByModel(new $model, $modelId, $params, $combine);
 	}

	public static function getTranslation($i18n_id, $locale_id = null)
 	{
 		$locale_id = ($locale_id===null?App::getLocale():$locale_id);
 		$cachePrefix = 'Eloquentizr::getTranslation:' . $locale_id . ':';
 		if (Cache::has($cachePrefix . $i18n_id)) {
 			return Cache::get($cachePrefix . $i18n_id);
 		}
 		$translation = Translation::where('i18n_id','=',$i18n_id)->where('locale_id','=',$locale_id)->first();

 		if (empty($translation)) {
 			$text = null;
 		} else {
 			$text = $translation->text;
 		}
 		
 		Cache::put($cachePrefix . $i18n_id, $text, 60);
 		return $text;
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

    /**
     * Simple relation for translate a text
     * @param  string $name key name
     * @param  string $lang lang
     * @return query
     */
    public function getText($name, $lang = null)
    {
    	if (is_null($lang)) {
    		$lang = App::getLocale();
    	}
    	return $this->hasOne('Translation', 'i18n_id', 'i18n_' . $name)->where('locale_id', '=', $lang);
    }
}