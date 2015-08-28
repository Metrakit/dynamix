<?php

namespace Dynamix\Models;

use Dynamix\Models\I18n;
use Dynamix\Models\FormMap;
use Dynamix\Models\InputType;
use Dynamix\Models\SelectOption;
use Dynamix\Models\Translation;

class InputView extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'inputs';
    public $timestamps = false;
    protected $fillable = ['name', 'view_id', 'i18n_placeholder', 'i18n_helper', 'i18n_label', 'type_id'];

    public static function formParams()
    {
        return array(        
            'type'  => 'horizontal',
            'title' => trans('crew::forms.create.title'),
            'description' => trans('crew::forms.create.description'),
            'data'  => array(
                'title' => array(
                    'name'        => 'title',
                    'type'        => 'text',
                    'rules'       => 'required',
                    'multiLang'   => true,
                    'viewPath'    => 'public.form.input.text',
                    'title'       => 'Title',
                    'placeholder' => 'Title',
                    'helper'      => 'Title',
                    'label'       => 'Title',
                ),               
                'placeholder' => array(
                    'name'        => 'placeholder',
                    'type'        => 'text',
                    'multiLang'   => true,
                    'viewPath'    => 'public.form.input.text',
                    'title'       => 'Placeholder',
                    'placeholder' => 'Placeholder',
                    'helper'      => 'Placeholder',
                    'label'       => 'Placeholder',
                ),   
                 'helper' => array(
                    'name'        => 'helper',
                    'type'        => 'text',
                    'multiLang'   => true,
                    'viewPath'    => 'public.form.input.text',
                    'title'       => 'Helper',
                    'placeholder' => 'Helper',
                    'helper'      => 'Helper',
                    'label'       => 'Helper',
                ),   
                 'label' => array(
                    'name'        => 'label',
                    'type'        => 'text',
                    'multiLang'   => true,
                    'viewPath'    => 'public.form.input.text',
                    'title'       => 'Label',
                    'placeholder' => 'Label',
                    'helper'      => 'Label',
                    'label'       => 'Label',
                ),                                  
                 'name' => array(
                    'name'        => 'name',
                    'type'        => 'text',
                    'rules'       => 'required',
                    'viewPath'    => 'public.form.input.text',
                    'title'       => 'Name',
                    'placeholder' => 'Name',
                    'helper'      => 'Name',
                    'label'       => 'Name',
                ),                  
                'type' => array(
                    'name'        => 'type',
                    'type'        => 'select',
                    'rules'       => 'required',
                    'viewPath'    => 'public.form.input.select',
                    'options'     => array(
                        array(
                            'key'   => 'password',
                            'value' => 'Password',
                        ), 
                        array(
                            'key'   => 'text',
                            'value' => 'Text',
                        ), 
                        array(
                            'key'   => 'textarea',
                            'value' => 'Textarea',
                        ), 
                        array(
                            'key'   => 'select',
                            'value' => 'Select',
                        ), 
                        array(
                            'key'   => 'multiselect',
                            'value' => 'Multi select',
                        ),                         
                         array(
                            'key'   => 'hidden',
                            'value' => 'Hidden',
                        ),                        
                        array(
                            'key'   => 'checkbox',
                            'value' => 'Checkbox',
                        ),                                                    
                        array(
                            'key'   => 'fileManager',
                            'value' => 'File manager',
                        ),     
                        array(
                            'key'   => 'submit',
                            'value' => 'Submit',
                        ),                                                                    
                    ),
                    'title'       => 'Type',
                    'placeholder' => 'Type',
                    'helper'      => 'Type',
                    'label'       => 'Type',
                ),
                'rules' => array(
                    'name'        => 'rules',
                    'type'        => 'multiselect',
                    'viewPath'    => 'public.form.input.multiselect',
                    'options'     => array(
                        array(
                            'key'   => 'required',
                            'value' => 'Required',
                        ), 
                        array(
                            'key'   => 'URL',
                            'value' => 'URL',
                        ), 
                        array(
                            'key'   => 'integer',
                            'value' => 'Integer',
                        ), 
                        array(
                            'key'   => 'ip',
                            'value' => 'IP',
                        ), 
                         array(
                            'key'   => 'image',
                            'value' => 'Image',
                        ),                        
                        array(
                            'key'   => 'email',
                            'value' => 'Email',
                        ),                                                    
                        array(
                            'key'   => 'date',
                            'value' => 'Date',
                        ),     
                        array(
                            'key'   => 'boolean',
                            'value' => 'Boolean',
                        ),  
                         array(
                            'key'   => 'alpha_num',
                            'value' => 'Alpha num',
                        ),                                                    
                        array(
                            'key'   => 'alpha_dash',
                            'value' => 'Alpha dash',
                        ),     
                        array(
                            'key'   => 'alpha',
                            'value' => 'Alpha',
                        ),                                                                                          
                    ),
                    'title'       => 'Rules',
                    'placeholder' => 'Rules',
                    'helper'      => 'Rules',
                    'label'       => 'Rules',
                ),
                'send' => array(
                    'name'        => 'send',
                    'type'        => 'submit',
                    'rules'       => 'required',
                    'viewPath'    => 'public.form.input.submit',
                    'title'       => 'Envoyer',
                    'placeholder' => 'Envoyer',
                    'helper'      => 'Envoyer',
                    'label'       => 'Envoyer',
                ),
            ),
            'method' => 'model'
        );
    }


    /**
     * Formr action
     * @param  Array $inputs
     */
    public static function formAction($dataInput)
    {
        //return var_dump($dataInput);
        if ( ! isset($dataInput['formParam']) || !isset($dataInput['formParam']['formId'])) {
            \App::abbort(404);
        }

        $form = \Formr::findOrFail($dataInput['formParam']['formId']);

        // recuperation de l'ordre pour le nouvel input
        $lastOrder = self::mapping($form);

        // Suppression du dernier pipe et surchage de "data['rules']"
        
        $dataInput['rules'] = isset($dataInput['rules']) ? self::generateRules($dataInput['rules']) : "";

        $view = Viewr::where('name', $dataInput['type'])->firstOrFail();

        $dataInput['view'] = $view->id;

        $dataInput = array_merge($dataInput, self::generateI18n($dataInput));

        $inputType = InputType::add($dataInput);
        $input = self::add($inputType->id, $dataInput);


        /**
         *
         *
         *
         *
         *
         *  A  FAIRE : TRAITER LES OPTIONS
         *
         *
         *
         *
         *
         * 
         */


        // Add options if the input type is a select
        if ($input->name = "select") {
            if (isset($dataInput['options'])) {
                foreach ($dataInput['options'] as $option) {
                    $option['key'] = I18n::add($option['key'], 'option_key');
                    $option['value'] = I18n::add($option['value'], 'option_value');
                    SelectOption::add($input->id, $option);
                }
            }
        }

        // Add form map
        FormMap::add($input->id, $form->id, $lastOrder);

        return redirect('admin.form.show', $form->id);

    }


    /**
     * Generate the i18n for inputs
     * @param  Array $data
     * @return Arrray
     */
    public static function generateI18n($data)
    {
        $texts = array();
        $texts['title']         = I18n::add($data['title'], 'title');
        $texts['label']         = I18n::add($data['label'], 'label');
        $texts['placeholder']   = I18n::add($data['placeholder'], 'placeholder');
        $texts['helper']        = I18n::add($data['helper'], 'helper');
        return $texts;
    }


    /**
     * Generate the rules for inputs
     * @param  Array $rules
     * @return Sring
     */
    public static function generateRules($dataRules)
    {
        $rules = "";

        foreach ($dataRules as $rule) {
            $rules .= $rule . '|';
        }

        return mb_substr($rules, 0 , -1);
    }

    /**
     * Genere le nouveau mappage et retourne l'order pour le nouvel input
     * @param  Object $form 
     * @return Integer
     */
    public static function mapping($form)
    {

        $lastInputMap = FormMap::join('inputs', 'inputs.id', '=', 'form_maps.input_id')
            ->join('views', 'views.id', '=', 'inputs.view_id')
            ->where('form_maps.form_id', $form->id)
            ->where('views.name', 'submit')
            ->first();
                   
        if (!$lastInputMap) {
            $lastInputMap = FormMap::where('form_id', $form->id)
                            ->orderBy('order', 'DESC')
                            ->first(); 

            $lastOrder = isset($lastInputMap) ? $lastInputMap->order+1 : 1;         
        } else {
            // On set l'odre du submit pour le nouveau input
            $lastOrder = $lastInputMap->order;
            // et on descend l'ordre su submit d'un cran pour qu'il reste en bas par défault
            $lastInputMap->order = $lastInputMap->order+1;
            $lastInputMap->save();
        }
        return $lastOrder;
    }

    /**
     * View relation
     * @return Query
     */
    public function getView()
    {
    	return $this->belongsTo('Dynamix\Models\Viewr', 'view_id')->first();
    }


    /**
     * Input type relation
     * @return Query
     */
    public function getType()
    {
    	return $this->belongsTo('Dynamix\Models\InputType', 'type_id')->first();
    }


    /**
     * Select Options relation
     * @return Query
     */
    public function getOptions()
    {
        return $this->hasMany('Dynamix\Models\SelectOption', 'input_id', 'input_id')->get();
    }




	/**
	 * Additional Method
	 *
	 * @var string
	 */
	public function translate( $i18n_id )
	{
		return Translation::where('i18n_id', '=', $i18n_id)->where('locale_id', '=', \App::getLocale())->first()->text;
	}


    /**
     * Add an input
     * @param  Array $data
     * @return  Self
     */
    public static function add($typeId, $data)
    {
        $input = new self;
        $input->name = $data['type'];
        $input->view_id = $data['view'];
        $input->i18n_placeholder = $data['placeholder'];
        $input->i18n_helper = $data['helper'];
        $input->i18n_label = $data['label'];
        $input->type_id = $typeId;
        $input->save();
        return $input;
    }

}