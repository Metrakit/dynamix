<?php

class Structure extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'structures';
	public $timestamps = false;

	/**
	 * Polymorphic relation
	 *
	 * @var string
	 */
	public function structurable()
    {
        return $this->morphTo();
    }



	public function title()
	{
		return 'text';
	}

	public function url()
	{
		return 'text';
	}

	public function meta_title()
	{
		return 'text';
	}

	public function meta_description()
	{
		return 'text';
	}
}