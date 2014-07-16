<?php

class Resource extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'resources';

	/**
     * A Resource is on many Permission
     *
     * @return mixed
     */
	public function permissions() {
        return $this->hasMany('Permission');
    }
}