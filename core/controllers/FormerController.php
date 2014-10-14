<?php

class FormerController extends Controller {

	public function store()
	{
                if (Input::has('form')) {
                    if (is_int(Input::get('form'))) {
                        $rules = Former::getRules(Input::get('form'));   
                    } else {
                        $rules = Former::getRulesByModel(Input::get('form'));   
                    }
                	
                } else {
                	App::abort(500, "Form ID not found !");
                }

                // Using the Validator
                $validator = Validator::make(Input::except('_token'), $rules);

                        // If errors we back to the previous forms with errors and old inputs
                if ($validator->fails()) {
                	return Redirect::back()->withErrors($validator)->withInput();        	
                }

                // Getting the form settings
                if ((!$form = Formr::find(Input::get('form')))) {
                	App::abort(500, "This Form doesnt exist !");
                }

                // Action to use if the form is valid
                if ($form->finish_on == "email") {
                	// Send a mail
                	
                	App::make('MailController')->formr(Input::except('_token'));

                } else if ($form->finish_on == "database") {
                	// Store in DB

                } else if ($form->finish_on == "model") {
                	Former::callModel($form, Input::except('_token'));    	
                } else {
                	App::abort(500, "No method found for send the form !");
                }

                // Redirect back with success message
                return Redirect::back()->with('formSuccess', Lang::get('messages.form.success'));

	}

}