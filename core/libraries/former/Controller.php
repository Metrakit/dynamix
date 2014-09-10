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
        $formMap = $this->formMap->where('form_id', $id)->get();

        // We make the query
        foreach ($formMap as $input) {
            $inputs = $this->inputs->orWhere('id', $input->input_id);
        }

        // Getting input objects
        $inputs = $this->inputs->get();

        // Boucle on inputs
        foreach ($inputs as $key => $input) {

            // Getting texts translated
            $inputs[$key]->i18n_placeholder = $this->translate->exec($input['i18n_placeholder']);
            $inputs[$key]->i18n_helper = $this->translate->exec($input['i18n_helper']);

            // Getting type
            $inputs[$key]->type = $inputs[$key]->getType()->name; 

            // If the input type is "Radio" we get the select options
            if ($inputs[$key]->type == "select") {
                $inputs[$key]->options = $input->getOptions();
                // Translate the Options
                foreach ($inputs[$key]->options as $optKey => $option) {
                    $inputs[$key]->options[$optKey]->i18n_key = $this->translate->exec($option->i18n_key);
                    $inputs[$key]->options[$optKey]->i18n_value = $this->translate->exec($option->i18n_value);
                }
            }

            // Getting path
            $inputView = $input->getView()->path;
            $inputs[$key]->view = \Response::view($inputView, $inputs[$key])->getOriginalContent();
        }

        return $inputs;
    }

}