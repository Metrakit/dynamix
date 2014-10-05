<?php

class ModelForm extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'model_form';
	public $timestamps = false;	
	protected $fillable = ['form_id', 'model'];


}