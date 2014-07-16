<?php

class BaseController extends Controller {

	/**
	 * Find and return the Object for an url
	 *
	 * @return void
	 */
	protected function slugExists( $slug )
	{
		$urls = Cache::get('DB_Urls');

		foreach( $urls as $url ){
			if( $url->text == '/' . $slug ){
				return $url;
			}
		}
		return false;
	}








	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
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