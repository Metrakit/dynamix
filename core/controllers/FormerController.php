<?php
class FormerController extends Controller {

    public function __construct()
    {
        if (Auth::check()) {
            $this->data['user'] = Auth::user();
        }
    }

    public function index()
    {
        $this->data['forms'] = Formr::all();
        return View::make('theme::' .'admin.formr.index', $this->data);
    }


    public function create()
    {
        return View::make('theme::' .'admin.formr.create', $this->data);
    }

    public function show($formID)
    {
        $this->data['form'] = Formr::findOrFail($formID);

        $this->data['displayInputs'] =  Former::getForm($formID, true);

        return View::make('theme::' .'admin.formr.show', $this->data);
    } 

    public function edit($formID)
    {
        $this->data['form'] = Formr::findOrFail($formID);

        return View::make('theme::' .'admin.formr.edit', $this->data);
    }   


    public function storeResult($modelId = null)
    {
        if (Input::has('form')) {
            if (is_int(Input::get('form'))) {
                $rules = Former::getRules(Input::get('form'));   
            } else {
                if (Input::has('combine_form')) {
                    $combine = true;
                } else {
                    $combine = false;
                }
                $rules = Former::getRulesByModel(Input::get('form'), $combine, $modelId);   
            }

            $unsets = array();

            // Ajoute les nouvelles regles i18n
            foreach (Input::all() as $key => $input) {
                if (strpos($key, '_lang_')) {
                    $splitInput = explode ("_", $key);
                    $rules[$key] = $rules[$splitInput[0]];
                    $unsets[$splitInput[0]] = $splitInput[0];
                }
            }

            // Supprime les anciennes regles
            foreach ($unsets as $value) {
                unset($rules[$value]);
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
        if (($form = Formr::find(Input::get('form')))) {
            // Action to use if the form is valid
            if ($form->finish_on == "email") {
                // Send a mail
                App::make('MailController')->formr(Input::alli18n());
            } else if ($form->finish_on == "database") {
                // Store in DB
            } else if ($form->finish_on == "model") {
                Former::callModel($form, Input::alli18n());      
            } else {
                App::abort(500, "No method found for send the form !");
            }
        } else {
            $modelName = Input::get('form');
            $model = new $modelName;
            if (isset($model)) {
                if (Input::has('combine_form')) {
                    $combine = true;
                } else {
                    $combine = false;
                }
                $formParams = $model->formParams($combine);
            }
            if ($formParams['method'] == "email") {
                // Send a mail
                App::make('MailController')->formr(Input::alli18n());
            } else if ($formParams['method'] == "database") {
                // Store in DB
            } else if ($formParams['method'] == "model") {
                return $model::formAction(Input::alli18n(), $modelId);      
            } else {
                App::abort(500, "No method found for send the form !");
            }
        }
        // Redirect back with success message
        return Redirect::back()->with('formSuccess', Lang::get('messages.form.success'));
    }
}