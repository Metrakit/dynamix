<?php

class Role extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'roles';

	/**
     * A Role is on many Permission
     *
     * @return mixed
     */
    public function users() {
        return $this->belongsToMany('User');
    }

    /**
     * A Role is on many Permission
     *
     * @return mixed
     */
    public function permissions() {
        return $this->hasMany('Permission');
    }
}