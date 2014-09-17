<?php

class InputType extends Eloquent {

	public $timestamps = false;
	protected $fillable = ['name', 'rules', 'defaultValue', 'i18n_title'];
	
}