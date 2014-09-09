<?php

class FormMap extends Eloquent{
	
	/**
	 * Parameters
	 */
	protected $table = 'form_maps';
	public $timestamps = false;
	protected $fillable = ['form_id', 'input_id', 'order'];

}