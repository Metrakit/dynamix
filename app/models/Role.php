<?php

class Role extends Eloquent
{
	/**
     * Parameters
     */
	protected $table = 'roles';


	/**
     * Relations
     *
     * @return mixed
     */
    public function users() {
        return $this->belongsToMany('User');
    }

    public function permissions() {
        return $this->hasMany('Permission');
    }

    /**
     * Polymorphic Relations
     *
     * @return mixed
     */
    public function trackable()
    {
        return $this->morphTo();
    }
}