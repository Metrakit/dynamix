<?php

class Formr extends Eloquent{
	
	/**
	 * Parameters
	 */
	protected $table = 'forms';
	public $timestamps = false;
	protected $fillable = ['finish_on', 'i18n_title', 'i18n_description', 'type'];

	
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
		$order = 0;

		foreach ($data['data'] as $dataInput) {

			// Increments the order
			$order++;

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
			FormMap::add($input->id, $form->id, $order);
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


	/**
	 * Generate a form by a model
	 * @param  Array $data
	 * @return  Self
	 */
	/*public function generateByModel($pageId, $order, $data)
	{
		// Creating form
		$form = new self;
		$form->finish_on = $data['method'];
		$form->type = $data['type'];
		$form->i18n_title = NULL;
		$form->i18n_description = NULL;
		$form->save();

		$order = 0;

		foreach ($data['data'] as $dataInput) {

			// Increments the order
			$order++;

			// Input Type
			$dataInput['i18n_title'] = NULL;
			$inputType = InputType::add($dataInput);

			// Input
			$dataInput['label'] = NULL;
			$dataInput['placeholder'] = NULL;
			$dataInput['helper'] = NULL;
			$input = InputView::add($inputType->id, $dataInput);

			// Add options if the input type is a select
			if ($input->name = "select") {

				if (isset($dataInput['options'])) {
					foreach ($dataInput['options'] as $option) {
						$option['i18n_key'] = NULL;
						$option['i18n_value'] = NULL;
						SelectOption::add($input->id, $option);
					}
				}
			}

			// Add form map
			FormMap::add($input->id, $form->id, $order);
		}

		// Add a block
		$block = Block::add($pageId, $order, 'Formr');
		BlockResponsive::add($block->id, 12, 3);

		// Add form model
		ModelForm::add($form->id, $data['model']);

		return $form;
	}*/


}