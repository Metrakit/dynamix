<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class AuthUser extends Eloquent implements UserInterface, RemindableInterface {

	/**
     * Parameters
     */    
	protected $table = 'auths';


    /**
     * Relations
     *
     * @var string
     */
    public function roles() {
        return $this->belongsToMany('Role', 'auth_role', 'auth_id', 'role_id');
    }

    public function articles() {
        return $this->hasMany('Article');
    }

    public function tracks() {
        return $this->hasMany('Track');
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
    public function hasPermission($action, $resource)
    {
        $action_id = Action::where('name','=',$action)->first()->id;
        $resource_id = Resource::where('name','=',$resource)->first()->id;

        foreach ( $this->roles as $role ) {
            foreach ( $role->permissionsAllowed as $permission ) {
                if ( $permission->action_id == $action_id
                   &&$permission->resource_id == $resource_id) return true;
            }
    }
    return false;
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

    public function getAuthPassword ()
    {
        return $this->password;
    }

    public function getReminderEmail ()
    {
        return $this->email;
    }

    public function getAuthIdentifier ()
    {
        return $this->getKey();
    }

    /**
     * Additionnal method
     *
     */
    public function getAuthorizedNavigations () {
        $resources = array();
        $navigations = '';
        
        foreach ($this->roles as $role) {
            foreach ($role->permissions as $permission) {
                $resources[] = $permission->resource_id;
            }
        }
        
        $resources = array_unique($resources);

        foreach ( $resources as $resource_id ) {
            $resource = Resource::find($resource_id);
            if ($resource->in_admin_ui == 1) {
                $data = array(
                    'name'  => $resource->name,
                    'icon'  => $resource->icon);
                $navigations .= Response::view('admin.interface.nav-li', $data )->getOriginalContent();
            }
        }
        
        return $navigations;
    }

    public function rolesList () {
        $str = '';
        foreach ( $this->roles as $role ) {
            $str .= ' '.$role->name.',';
        }
        return substr ($str, 1, strlen($str) - 2);
    }
}