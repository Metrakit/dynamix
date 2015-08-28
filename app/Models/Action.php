<?php

namespace Dynamix\Models;

class Action extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'actions';
    public $timestamps = false;

	/**
     * An Action is on many Permission
     *
     * @return mixed
     */
	public function permissions() {
        return $this->hasMany('Dynamix\Models\Permission');
    }

    /**
     * A Role is on many Permission
     *
     * @return mixed
     */
    public function trackings() {
        return $this->hasMany('Dynamix\Models\Tracking');
    }
}