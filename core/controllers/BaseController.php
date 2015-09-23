<?php

class BaseController extends Controller {


	public function __construct()
	{
		if (Config::get('core::extend.base_controller')) {
			View::share('global', Config::get('core::extend.base_controller'));
		}		
	}



	/**
	 * store in db action
	 *
	 * @return array
	 */
	protected function track ($action, $model, $id) {
		$track = new Track();
		$track->auth_id = Auth::user()->id;
		$track->date = new Datetime;
		$track->action = $action;
		$track->trackable_id = $id;
		$track->trackable_type = $model;
		return $track->save();
	}

	/**
	 * return an array of Object for all not allowed resources
	 *
	 * @return array
	 */
	protected function getResourceNotAllowed () {
		$notAllowed = array();
		$resourceNavigable = Resource::where('navigable','=',1)->get();

		foreach ( $resourceNavigable as $resource ) {
			$modelName = $resource->model;
			//Si la clé allowed['resource'] exists, put the objet in this
			$objects = $modelName::getNotAllowed();

			if (count($objects)>0) {				
				if ( isset($notAllowed[$modelName]) ) {
					$notAllowed[$modelName] = array_merge( $notAllowed[$modelName], $objects );
				} else {
					$notAllowed[$modelName] = $objects;
				}
			}

		}

		return $notAllowed;
	}


	/*protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make('theme::' .$this->layout);
		}
	}

	protected function redirectAction($action, $data = [])
    {
        return Redirect::action($action, $data);
    }

    protected function redirectRoute($route, $data = [])
    {
        return Redirect::route($route, $data);
    }

    protected function redirectBack($data = [])
    {
        return Redirect::back()->withInput()->with($data);
    }

    protected function redirectIntended($defaultAction = null)
    {
        return Redirect::intended($defaultAction);
    }*/

}