<?php

class InputType extends Eloquent {

	public $timestamps = false;
	protected $fillable = ['name', 'rules', 'defaultValue', 'i18n_title'];

	/**
     * Add an input type
     * @param  Array $data
     * @return  Self
     */
    public static function add($data)
    {
        $inputType = new self;
        $inputType->name = $data['name'];
        $inputType->rules = $data['rules'];
        $inputType->i18n_title = $data['title'];
        $inputType->save();
        return $inputType;
    }
	
}