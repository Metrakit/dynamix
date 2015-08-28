<?php

namespace Dynamix\Models;

class Track extends Model {

	/**
     * Parameters
     */
	protected $table = 'tracks';
    public $timestamps = false;
    public static $langNav = 'admin.nav_log';

	
    /**
     * Additional Method
     *
     * @var string
     */
	public function user() 
    {
        return $this->hasOne('Dynamix\Models\User','id','user_id');
    }

	public function action() 
    {
        return $this->hasOne('Dynamix\Models\Action');
    }

    /**
     * Attributes
     *
     * @return mixed
     */

    public function userName() 
    {
        return $this->user->firstname . ' ' . $this->user->lastname;
    }
}