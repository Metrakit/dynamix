<?php

class Tracking extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'trackings';
    public $timestamps = false;

	/**
     * An tracking has belong to many user
     *
     * @return mixed
     */
	public function user() {
        return $this->hasOne('User');
    }

    /**
     * An tracking has belong to many user
     *
     * @return mixed
     */
	public function action() {
        return $this->hasOne('Action');
    }

    /**
     * An tracking has belong to many user
     *
     * @return mixed
     */
	public function resource() {
        return $this->hasOne('Resource');
    }
}