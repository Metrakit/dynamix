<?php namespace FormGenerator;

use Config;

class Former extends \Controller {

    /**
     * The application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;
    /**
     * @var Object
     */
    protected $translate;
    /**
     * @var Object
     */    
    protected $formMap;
    /**
     * @var Object
     */
    protected $inputs;
    /**
     * @var Integer
     */
    protected $formId;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct($app)
    {
        $this->app = $app;

        // Initialisation des objets
        $this->translate  = Config::get('model.translation');
        $this->formMap    = Config::get('model.formMap');
        $this->inputs     = Config::get('model.input');

        // If a model doesnt exist we display an error in the debugger
        if (!$this->translate || !$this->formMap || !$this->inputs) {
            throw new \Exception(get_called_class() . ' did not find a model in the Config file !');
        }
    }

    /**
     * Get all Inputs
     * @return Aray
     */
    public function getInputs()
    {
        // Form mapping
        
        /*$formMap = $this->formMap->where('form_id', $this->formId)
                                 ->orderBy('order', 'asc')
                                 ->get();
        // We make the query
        foreach ($formMap as $input) {
            $inputs = $this->inputs->orWhere('id', $input->input_id);
        }
        // Getting input objects
        return $this->inputs->get();*/

        return $this->inputs->join('form_maps', 'form_maps.input_id', '=', 'inputs.id')
         ->where('form_maps.form_id', $this->formId)
         ->orderBy('form_maps.order', 'asc')
         ->get();
    }

    /**
     * Display the form
     * @param  Integer $id
     * @return Object
     */
    public function render($form)
    {    
        $this->formId = $form->id;
        $inputs = $this->getInputs();

        // Boucle on inputs
        foreach ($inputs as $key => $input) {

            // Getting texts translated
            if (isset($input['i18n_placeholder'])) {
                $inputs[$key]->placeholder = $this->translate->exec($input['i18n_placeholder']);
            } else {
                $inputs[$key]->placeholder = null;
            }

            if (isset($input['i18n_helper'])) {
                $inputs[$key]->helper = $this->translate->exec($input['i18n_helper']);
            } else {
                $inputs[$key]->helper = null;
            }

            if (isset($input['i18n_label'])) {
                $inputs[$key]->label = $this->translate->exec($input['i18n_label']);
            } else {
                $inputs[$key]->label = null;
            }
            
            // Set type
            $inputs[$key]->type = $input->name; 

            // InputType - relation
            $inputType = $input->getType();

            // Getting and set name
            $inputs[$key]->name = $inputType->name; 

            // Set the Inputs value
            if (\Input::old($inputType->type)) {
                $inputs[$key]->value = \Input::old($inputType->name);
            } else if($inputType->defaultValue) {
                $inputs[$key]->value = $inputType->defaultValue;
            } else {
                $inputs[$key]->value = null;
            }

            // Get and translate the title
            $inputs[$key]->title = $this->translate->exec($inputs[$key]->getType()->i18n_title); 

            // If the input type is "Radio" we get the select options
            if ($inputs[$key]->type == "select") {
                $inputs[$key]->options = $input->getOptions();
                // Translate the Options
                foreach ($inputs[$key]->options as $optKey => $option) {
                    $inputs[$key]->options[$optKey]->key = $this->translate->exec($option->i18n_key);
                    $inputs[$key]->options[$optKey]->value = $this->translate->exec($option->i18n_value);
                }
            }

            // Getting path
            $inputView = $input->getView()->path;
            $inputs[$key]->view = \Response::view($inputView, array(
                'form' => $form,
                'input' => $inputs[$key]
            ))->getOriginalContent();
        }

        return $inputs;
    }

    /**
     * Get rules for the validator
     * @param  Integer $id 
     * @return Array
     */
    public function getRules($id)
    {
        $this->formId = $id;
        $inputs = $this->getInputs();
        
        foreach ($inputs as $key => $input) {
            $inputType = $input->getType();
            $rules[$inputType->name] = $inputType->rules;
        }
        
        return $rules;
    }



}