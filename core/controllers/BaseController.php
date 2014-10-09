<?php

class BaseController extends Controller {




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
			$notAllowed = array_merge( $notAllowed, $modelName::getNotAllowed() );
		}

		return $notAllowed;
	}


	/*protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
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