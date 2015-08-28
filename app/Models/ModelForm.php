<?php

namespace Dynamix\Models;

class ModelForm extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table    = 'model_form';
	public $timestamps  = false;	
	protected $fillable = ['form_id', 'model'];

	/**
	 * Add a new model form for a form
	 * @param Integer $formId
	 * @param String $model
	 */
	public static function add($formId, $model)
	{
		$modelForm = new self;
		$modelForm->form_id = (int) $formId;
		$modelForm->model = (string) $model;
		$modelForm->save();
		return $modelForm;
	}


}