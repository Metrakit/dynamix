<?php

/*
Use to manage simple module for rendering in Block
*/

class Module extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'modules';
    public $timestamps = false;

    /**
     * #Pager method
     *
     * @return mixed
     */
    public function renderResource()
    {
        $model_name = $this->target_model;
        return $model_name::first()->renderResource();
    }
}