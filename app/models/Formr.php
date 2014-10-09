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

	/**
	 * Generate a form by a model
	 * @param  Array $data
	 * @return  Self
	 */
	public function generateByModel($data)
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

		// Add form model
		ModelForm::add($form->id, $data['model']);

		return $form;
	}

}