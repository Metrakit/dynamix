<?php

class Role extends Eloquent
{
	/**
     * Parameters
     */
	protected $table = 'roles';
    public static $langNav = 'admin.nav_role_';


	/**
     * Relations
     *
     * @return mixed
     */
    public function auths() {
        return $this->belongsToMany('AuthUser', 'auth_role', 'auth_id', 'role_id');
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
        //Check if users has this role
        if ( $this->auths->count() === 0 && $this->deletable ) {
            return true;
        }
        return false;
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