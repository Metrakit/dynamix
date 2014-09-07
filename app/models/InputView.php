<?php

class InputView extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'inputs';
    public $timestamps = false;
    protected $fillable = ['view_id', 'i18n_placeholder', 'i18n_helper', 'type_id'];


}