<?php

class FormerController extends Controller {

	public function store()
	{

		if (Input::has('form')) {
			$rules = Former::getRules(Input::get('form'));
		} else {
			throw new InvalidArgumentException("Form ID not found !", 500);			
		}
		
		$validator = Validator::make(Input::except('_token'), $rules);

        if ($validator->passes()) {
        	return Redirect::back()->with('formSuccess', Lang::get('messages.form.success'));
        } else {
        	return Redirect::back()->withErrors($validator)->withInput();
        }

	}


}