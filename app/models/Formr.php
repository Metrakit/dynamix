<?php

class Formr extends Eloquent{
	
	/**
	 * Parameters
	 */
	protected $table = 'forms';
	public $timestamps = false;

    //Blockable
    public static $blockable_type = 'Formr';

    //Navigable
	public static $langNav = 'admin.nav_form';

	protected $fillable = ['finish_on', 'i18n_title', 'i18n_description', 'type'];

	
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
                    'title'       => Lang::get('crew::forms.create.blog.inputs.name.title'),
                    'placeholder' => Lang::get('crew::forms.create.blog.inputs.name.placeholder'),
                    'helper'      => Lang::get('crew::forms.create.blog.inputs.name.helper'),
                    'label'       => Lang::get('crew::forms.create.blog.inputs.name.label'),
                ),               
                'description' => array(
                    'name'        => 'description',
                    'type'        => 'textarea',
                    'rules'       => 'required',
                    'multiLang'   => true,
                    'viewPath'    => 'public.form.input.textarea',
                    'title'       => Lang::get('crew::forms.create.inputs.bio.title'),
                    'placeholder' => Lang::get('crew::forms.create.inputs.bio.placeholder'),
                    'helper'      => Lang::get('crew::forms.create.inputs.bio.helper'),
                    'label'       => Lang::get('crew::forms.create.inputs.bio.label'),
                ),
                'finish_on' => array(
                    'name'        => 'finish_on',
                    'type'        => 'select',
                    'rules'       => 'required',
                    'viewPath'    => 'public.form.input.select',
                    'options'     => array(
                        array(
                            'key'   => 'database',
                            'value' => 'Database',
                        ), 
                        array(
                            'key'   => 'email',
                            'value' => 'Email',
                        ),                       
                    ),
                    'title'       => Lang::get('input.gallery.description.title'),
                    'placeholder' => Lang::get('input.gallery.description.placeholder'),
                    'helper'      => Lang::get('input.gallery.description.helper'),
                    'label'       => Lang::get('input.gallery.description.label'),
                ),
                'type' => array(
                    'name'        => 'type',
                    'type'        => 'select',
                    'rules'       => 'required',
                    'viewPath'    => 'public.form.input.select',
                    'options'     => array(
                        array(
                            'key'   => 'normal',
                            'value' => 'Normal',
                        ), 
                        array(
                            'key'   => 'inline',
                            'value' => 'Inline',
                        ), 
                        array(
                            'key'   => 'horizontal',
                            'value' => 'Horizontal',
                        ),                       
                    ),
                    'title'       => Lang::get('input.gallery.description.title'),
                    'placeholder' => Lang::get('input.gallery.description.placeholder'),
                    'helper'      => Lang::get('input.gallery.description.helper'),
                    'label'       => Lang::get('input.gallery.description.label'),
                ),
                'send' => array(
                    'name'        => 'send',
                    'type'        => 'submit',
                    'rules'       => 'required',
                    'viewPath'    => 'public.form.input.submit',
                    'title'       => Lang::get('crew::forms.create.inputs.send.title'),
                    'placeholder' => Lang::get('crew::forms.create.inputs.send.placeholder'),
                    'helper'      => Lang::get('crew::forms.create.inputs.send.helper'),
                    'label'       => Lang::get('crew::forms.create.inputs.send.label'),
                ),
            ),
            'method' => 'model'
        );
    }


	public static function formAction($inputs, $modelId)
    {
        if (null == $modelId) {
            $form = new self;
            $form->i18n_title = i18n::add($inputs['title'], 'title');
            $form->i18n_description = i18n::add($inputs['description'], 'description');
        } else {
        	$form = Self::find($modelId);
            i18n::change($form->i18n_title, $inputs['title']);
            i18n::change($form->i18n_description, $inputs['description']);
        }

        //var_dump($inputs); die;

        $form->finish_on = $inputs['finish_on'];
        $form->type = $inputs['type'];
        $form->save();

        if (null == $modelId) {
            return Redirect::route('admin.form.show', $form->id)->with('success', Lang::get('forms.create.success'));
        } else {
        	return Redirect::route('admin.form.show', $form->id)->with('success', Lang::get('forms.update.success'));
        }

    }


	/**
	 * Relations
	 *
	 * @var string
	 */


    /**
     * Attributes
     *
     * @return mixed
     */
    public static function getFreeObjects()
    {       
    	//get objects not free in block table
    	$model = get_class(new self);
    	$blocks_not_free = Block::where('blockable_type', $model)->select('blockable_id')->get();
    	$items = $model::select('id')->get();
    	$block_ids = array();
    	foreach ($blocks_not_free as $block) {
    		$block_ids[] = $block->blockable_id;
    	}

    	$data =array();
    	foreach ($items as $item) {
    		if (!in_array($item->id, $block_ids)) $data[] = $item;
    	}
    	return $data;
    }

       
    /**
     * #Pager method
     *
     * @return mixed
     */
    public function renderResource()
    {
    	$data['form'] = $this;
    	$data['inputs'] = Former::render($data['form']);
    	$data['modelId'] = null;
    	$data['builder'] = false;
        return Response::view('public.form.form', $data )->getOriginalContent();
    }

	/**
	 * Additional Method
	 *
	 * @var string
	 */
	public function translate( $i18n_id )
	{
		return Translation::where('i18n_id','=',$i18n_id)->where('locale_id','=',App::getLocale())->first()->text;
	}

	public function title()
	{
		return $this->translate($this->i18n_title);
	}

	public function description()
	{
		return $this->translate($this->i18n_description);
	}


	/**
	 * Model relation
	 * @return Query
	 */
	public function model()
	{
		return $this->hasMany('ModelForm', 'form_id');
	}


	/**
	 * Get the model to a form
	 * @return Object	 
	*/
	public function getModel()
	{
		return $this->model()->first();
	}


	public function generate($data, $pageId, $order)
	{
		$form = new self;
		$fromObject = false;

		if (is_object($data)) {
			$data = $data->formr();
			$form->i18n_title = NULL;
			$form->i18n_description = NULL;
			$fromObject = true;
		}

		$form->finish_on = $data['method'];
		$form->type = $data['type'];
		$form->save();
		$orderMap = 0;

		foreach ($data['data'] as $dataInput) {

			// Increments the order
			$orderMap++;

			if ($fromObject) {
				$dataInput['title'] = NULL;
				$dataInput['label'] = NULL;
				$dataInput['placeholder'] = NULL;
				$dataInput['helper'] = NULL;		
			} else {
				$dataInput['title'] = i18n::add($dataInput['title'], 'title');
				$dataInput['label'] = i18n::add($dataInput['label'], 'label');
				$dataInput['placeholder'] = i18n::add($dataInput['placeholder'], 'placeholder');
				$dataInput['helper'] = i18n::add($dataInput['helper'], 'helper');
			}

			$inputType = InputType::add($dataInput);
			$input = InputView::add($inputType->id, $dataInput);

			// Add options if the input type is a select
			if ($input->name = "select") {

				if (isset($dataInput['options'])) {
					foreach ($dataInput['options'] as $option) {
						if ($fromObject) {
							$option['key'] = NULL;
							$option['value'] = NULL;
						} else {
							$option['key'] = i18n::add($option['key'], 'option_key');
							$option['value'] = i18n::add($option['value'], 'option_value');
						}
						SelectOption::add($input->id, $option);
					}
				}
			}

			// Add form map
			FormMap::add($input->id, $form->id, $orderMap);
		}

		// Add a block if the form is not by a model
		if (!$fromObject) {
			$block = Block::add($pageId, $order, 'Formr');
			BlockResponsive::add($block->id, 12, 3);
		}
		

		if ($fromObject) {
			// Add form model
			ModelForm::add($form->id, $data['model']);
		}

		// Generate a migrate file
		if ($form->finish_on == "database") {
			// Prepare migrate content
			$contentMigrate = $this->prepareMigrate($data['data']);
			$bob = new Migrator('form_' . $form->id, $contentMigrate);
 			$bob->generate();
		}

		return $form;
	}

	public function prepareMigrate($data)
	{
		$content = "";
		foreach ($data as $input) {
			if ($input['type'] != "submit") {
				$content .= "\t\t\t";
				if ($input['type'] == "textarea") {
					$content .= '$table->text("'. $input['name'] .'");';
				} else {
					$content .= '$table->string("'. $input['name'] .'");';
				}
				$content .= "\r\n";
			}
		}
		return $content;
	}

}