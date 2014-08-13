<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
     * Parameters
     */    
	protected $table = 'users';


    /**
     * Relations
     *
     * @var string
     */
    public function roles() {
        return $this->belongsToMany('Role');
    }

    public function articles() {
        return $this->hasMany('Article');
    }

    public function trackings() {
        return $this->hasMany('Tracking');
    }


    /**
     * Attributes
     *
     */
	protected $hidden = array('password');


    /**
     * hasRole
     *
     */
    public function hasRole($key)
    {
        foreach ($this->roles as $role) {            
            if ($role->name === $key) {
                return true;
            }
        }        
        return false;
    }

    /**
     * hasPermissions
     *
     */
    public function hasPermissions($key)
    {
        // todo
    }


    /**
     * Reminder
     *
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getReminderEmail()
    {
        return $this->email;
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }
}