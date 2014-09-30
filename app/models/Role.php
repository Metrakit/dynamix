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
    public function trackable() {
        return $this->morphTo();
    }

    /**
     * Additional Method
     *
     * @var string
     */
    public function isDeletable() {
        return $this->deletable;
    }

    public function hasResource( $id ) {
        foreach ( $this->permissionsAllowed as $permission ) {
            if ( $permission->resource->id === $id ) return true;
        }
        return false;
    }

    public function permissionsAllowed() {
        return $this->hasMany('Permission')->where('type','=','allow');
    }

}