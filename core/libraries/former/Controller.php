<?php namespace FormGenerator;

use Config;

/**
 * Form Generator - Dynamix
 * @version 1.0
 * @example Former::create($data)
 * @author David LEPAUX <d.lepaux@gmail.com>
 * @author Jordane JOUFFROY <contact@jordane.net>
 */
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
        $this->formr      = Config::get('model.formr');
        $this->inputs     = Config::get('model.input');
        $this->view     = Config::get('model.view');

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

        return $this->inputs->join('form_maps', 'form_maps.input_id', '=', 'inputs.id')
         ->where('form_maps.form_id', $this->formId)
         ->orderBy('form_maps.order', 'asc')
         ->get();
    }


    /**
     * Récupère un texte en DB ou dans un fichier de config en fonction du type de form
     * @param string $string
     * @return string
     */
    public function getTranslation($string, $row, $langStart)
    {
        if ($string) {
            return $this->translate->exec($string);
        } else {
            return \Lang::get($langStart . $row);
        }
    }


    /**
     * Génère a form by a model
     * @param  Object $form
     * @return Array
     */
    public function generateByModel($form)
    {
        $data = array();

        // Cast l'array en objet
        $data['form'] = (object) $form;

        // Cast l'array en objet
        $form = (object) $form->formr();
        $data['form']->id = $form->model;

        if (isset($form->action)) {
            $data['form']->action = $form->action; 
        }
       
        $inputs = $form->data;

        // Boucle sur les inputs
        foreach ($inputs as $key => $input) {

            $data['inputs'][$key] = (object) $input;
            $data['inputs'][$key]->name = $key;

            if (!isset($data['inputs'][$key]->value)) {
                $data['inputs'][$key]->value = NULL;
            }

            $data['inputs'][$key]->key = NULL;

            // Si c'est un select on génère les options
            if ($data['inputs'][$key]->type == "select") {
                foreach ($data['inputs'][$key]->options as $keyOpt => $option) {
                    $options[$keyOpt] = (object) $option;
                }
                $data['inputs'][$key]->options = $options;
            }
            
            // Génération des vues
            $data['inputs'][$key]->view = \Response::view( $data['inputs'][$key]->viewPath, array(
                'form' => $form,
                'input' => $data['inputs'][$key]
            ))->getOriginalContent();

        }



        return $data;

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

        $this->model = $form->getModel();

        // Boucle on inputs
        foreach ($inputs as $key => $input) {
            
            // Set type
            $inputs[$key]->type = $input->name; 

            // InputType - relation
            $inputType = $input->getType();



            if ($form->model && isset($this->model->model)) {
                $langInput = 'input.' . strtolower($this->model->model) . '.' . $inputType->name. '.';
            } else {
                $langInput = NULL;
            }
            

            // Getting texts translated
            $inputs[$key]->placeholder = $this->getTranslation($input['i18n_placeholder'], 'placeholder', $langInput);
            $inputs[$key]->helper = $this->getTranslation($input['i18n_helper'], 'helper', $langInput);
            $inputs[$key]->label = $this->getTranslation($input['i18n_label'], 'label', $langInput);
            $inputs[$key]->title = $this->getTranslation($inputType->i18n_title, 'title', $langInput);

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

            // If the input type is "Radio" we get the select options
            if ($inputs[$key]->type == "select") {
                $inputs[$key]->options = $input->getOptions();
                // Translate the Options
                foreach ($inputs[$key]->options as $optKey => $option) {
                    $langOption = $langInput . 'options.';
                    $inputs[$key]->options[$optKey]->key = $this->getTranslation($option->i18n_key, $optKey . '.key', $langOption);
                    $inputs[$key]->options[$optKey]->value = $this->getTranslation($option->i18n_value, $optKey . '.value' , $langOption);              
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

    public function getRulesByModel($modelName)
    {

        $inputs = $modelName::formParams()['data'];

        foreach ($inputs as $key => $input) {
            $data[$key] = $input['rules'];
        }

        return $data;
    }


    /**
     * Get a model name by the model settings in a Form
     * @param  Object $form 
     * @return String
     */
    public function getmodel($form)
    {
        if ($form->finish_on != "model") {
            throw new \Exception('The form is not connected to a model.');
        }  

        $model = $form->getModel();

        if (!$model) {
            throw new \Exception('The form is not connected to a model.');
        }

        return $model->model;
    }


    /**
     * Call the model declared in the form
     * @param  Object $form
     * @param  Array $inputs
     */
    public function callModel($form, $inputs)
    {
        $modelName = $this->getModel($form);

        $model = $modelName::getForm($inputs);
    }




    public function create($data, $pageId = NULL, $order = NULL)
    {
        /*if (is_object($data)) {
            return $this->createFromModel($pageId, $order, $data);
        } else {
            return $this->createFromForm($pageId, $order, $data);
        }*/

        return $this->formr->generate($data, $pageId, $order);
    }



    /**
     * Display a form by an Id
     * @param  Integer $formId
     * @return Response
     */
    public function getForm($formId)
    {
        if ((!$data['form'] = $this->formr->find($formId))) {
            throw new Exception("No form found !", 1);      
        }
        $data['inputs'] = self::render($data['form']);
        return \Response::view('public.form.form', $data)->getOriginalContent();
    }

    /**
     * Display a form by an Id
     * @param  Integer $formId
     * @return Response
     */
    public function renderByModel($model)
    {
        $data = self::generateByModel($model);
        return \Response::view('public.form.form', $data)->getOriginalContent();
    }


    /**
     * Create a form since a Object (Model)
     * @param  Object $object (should contain "formr" method)
     * @return boolean
     */
    /*public function createFromForm($pageId, $order, $data)
    {
        // Verifs
        if (!is_object($object)) {
            throw new \InvalidArgumentException('You should give an object to this method.');
        }

        if (!method_exists($object, 'formr')) {
            throw new \InvalidArgumentException('Method "formr" not found in the ' . get_class($object) . ' object.');
        }

        $data = $object->formr();

        if (!isset($data['description']) || NULL === $data['description']) {
            throw new \InvalidArgumentException('Argument "description" not found or cannot be null in the form array.');
        }

        if (!isset($data['title']) || NULL === $data['title']) {
            throw new \InvalidArgumentException('Argument "title" not found or cannot be null in the form array.');
        } 

        // If all is okay...
        $this->formr->generateByModel($pageId, $order, $data);
    }*/




    /**
     * Create a form since a Object (Model)
     * @param  Object $object (should contain "formr" method)
     * @return boolean
     */
    /*public function createFromModel($pageId, $order, $object)
    {
        // Verifs
        if (!is_object($object)) {
            throw new \InvalidArgumentException('You should give an object to this method.');
        }

        if (!method_exists($object, 'formr')) {
            throw new \InvalidArgumentException('Method "formr" not found in the ' . get_class($object) . ' object.');
        }

        $data = $object->formr();

        if (!isset($data['description']) || NULL === $data['description']) {
            throw new \InvalidArgumentException('Argument "description" not found or cannot be null in the form array.');
        }

        if (!isset($data['title']) || NULL === $data['title']) {
            throw new \InvalidArgumentException('Argument "title" not found or cannot be null in the form array.');
        } 

        // If all is okay...
        $this->formr->generateByModel($pageId, $order, $data);
    }*/

}