<?php

namespace Dynamix\Models;

class FormMap extends Model {
	
	/**
	 * Parameters
	 */
	protected $table = 'form_maps';
	public $timestamps = false;
	protected $fillable = ['form_id', 'input_id', 'order'];

	/**
	 * Add a mapping of a form
	 * @param Integer $iput->id
	 * @param Integer $formId
	 * @param Integer $order
	 */
	public static function add($inputId, $formId, $order)
	{
		$formMap = new self;
		$formMap->input_id = $inputId;
		$formMap->form_id = $formId;
		$formMap->order = $order;
		$formMap->save();
		return $formMap;
	}

}