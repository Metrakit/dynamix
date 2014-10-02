<?php

class Track extends Eloquent{

	/**
     * Parameters
     */
	protected $table = 'tracks';
    public $timestamps = false;

	
    /**
     * Additional Method
     *
     * @var string
     */
	public function user() {
        return $this->hasOne('User','id','user_id');
    }

	public function action() {
        return $this->hasOne('Action');
    }

    /**
     * Attributes
     *
     * @return mixed
     */

    public function userName() {
        return $this->user->firstname . ' ' . $this->user->lastname;
    }
}