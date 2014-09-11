<?php namespace FormGenerator;

use Config;

class Former extends \Controller {

    /**
     * The application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    protected $translate;
    protected $formMap;

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
	 * display a Page, and his Blocks
	 *
	 * @var Page
	 */
    public function render($id)
    {
        // Form mapping
        $formMap = $this->formMap->where('form_id', $id)
                                 ->orderBy('order', 'asc')
                                 ->get();

        // We make the query
        foreach ($formMap as $input) {
            $inputs = $this->inputs->orWhere('id', $input->input_id);
        }

        // Getting input objects
        $inputs = $this->inputs->get();

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
            
            // Getting type
            $inputs[$key]->type = $inputs[$key]->getType()->name; 

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
            $inputs[$key]->view = \Response::view($inputView, $inputs[$key])->getOriginalContent();
        }

        return $inputs;
    }

}