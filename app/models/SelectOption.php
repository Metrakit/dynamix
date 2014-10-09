<?php

class SelectOption extends Eloquent {

	public $timestamps = false;
	protected $fillable = ['input_id', 'i18n_key', 'i18n_value'];

	/**
	 * Create a new option for a select
	 * @param Integer $inputId
	 * @param Array $data
	 */
	public static function add($inputId, $data)
	{
		$option = new self;
		$option->input_id = $inputId;
		$option->i18n_key = $data['i18n_key'];
		$option->i18n_value = $data['i18n_value'];
		$option->save();
		return $option;
	}
	
}