<?php

class InputValidator extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    public $timestamps = false;
    protected $fillable = ['rules', 'type_id'];

}