<?php

class InputView extends Eloquent{
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
            'title' => Lang::get('crew::forms.create.title'),
            'description' => Lang::get('crew::forms.create.description'),
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
                'multiLang' => array(
                    'name'        => 'multiLang',
                    'type'        => 'checkbox',
                    'viewPath'    => 'public.form.input.checkbox',
                    'title'       => 'Multi langues',
                    'placeholder' => 'Multi langues',
                    'helper'      => 'Multi langues',
                    'label'       => 'Multi langues',
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
     * View relation
     * @return Query
     */
    public function getView()
    {
    	return $this->belongsTo('Viewr', 'view_id')->first();
    }


    /**
     * Input type relation
     * @return Query
     */
    public function getType()
    {
    	return $this->belongsTo('InputType', 'type_id')->first();
    }


    /**
     * Select Options relation
     * @return Query
     */
    public function getOptions()
    {
        return $this->hasMany('SelectOption', 'input_id', 'input_id')->get();
    }




	/**
	 * Additional Method
	 *
	 * @var string
	 */
	public function translate( $i18n_id )
	{
		return Translation::where('i18n_id', '=', $i18n_id)->where('locale_id', '=', App::getLocale())->first()->text;
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