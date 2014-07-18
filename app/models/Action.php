<?php

class Action extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'actions';

	/**
     * An Action is on many Permission
     *
     * @return mixed
     */
	public function permissions() {
        return $this->hasMany('Permission');
    }

    /**
     * A Role is on many Permission
     *
     * @return mixed
     */
    public function trackings() {
        return $this->hasMany('Tracking');
    }
}