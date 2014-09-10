<?php

class SelectOption extends Eloquent {

	public $timestamps = false;
	protected $fillable = ['input_id', 'i18n_key', 'i18n_value'];
	
}