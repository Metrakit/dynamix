<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class AuthUser extends Eloquent implements UserInterface, RemindableInterface {

	/**
     * Parameters
     */    
	protected $table = 'auths';
    public static $langNav = 'admin.nav_auth';


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

        //order resources
        $data_by_group = array();
        foreach ( Config::get('admin.nav_admin.groups') as $group) {
            foreach ( $resources as $resource_id ) {
                $resource = Resource::find($resource_id);
                if ($resource->in_admin_ui == 1) {                    
                    if ($resource->group == $group) $data_by_group['group'.$group] = $resource;
                }
            }
        }

        //Make data
        $data_temp = $data_by_group['group0'];
        foreach ($data_by_group as $groupKey => $groupValue) {
            if ($groupKey > 1) {
                $data_temp[] = $data_by_group[$groupKey];
            }
        }

        return var_dump($data_temp);

        //
        /*foreach ( $data_by_group as $resource ) {
            $resource = Resource::find($resource_id);
            if ($resource->in_admin_ui == 1) {
                $model_name = ucfirst ($resource->model);
                Log::info($model_name);
                $lang = ($resource->model!=''?$model_name::$langNav:'admin.nav_' . $resource->name);
                if(Config::get('display.onepage') && $resource->navigable != 1) {
                    $data = array(
                        'name'  => $resource->name,
                        'lang'  => $lang,
                        'icon'  => $resource->icon);
                    $navigations .= Response::view('admin.interface.nav-li', $data )->getOriginalContent();
                } else if (!Config::get('display.onepage')) {
                    $data = array(
                        'name'  => $resource->name,
                        'lang'  => $lang,
                        'icon'  => $resource->icon);
                    $navigations .= Response::view('admin.interface.nav-li', $data )->getOriginalContent();
                }
            }
        }*/

        /*foreach ( $resources as $resource_id ) {
            $resource = Resource::find($resource_id);
            if ($resource->in_admin_ui == 1) {
                $model_name = ucfirst ($resource->model);
                Log::info($model_name);
                $lang = ($resource->model!=''?$model_name::$langNav:'admin.nav_' . $resource->name);
                if(Config::get('display.onepage') && $resource->navigable != 1) {
                    $data = array(
                        'name'  => $resource->name,
                        'lang'  => $lang,
                        'icon'  => $resource->icon);
                    $navigations .= Response::view('admin.interface.nav-li', $data )->getOriginalContent();
                } else if (!Config::get('display.onepage')) {
                    $data = array(
                        'name'  => $resource->name,
                        'lang'  => $lang,
                        'icon'  => $resource->icon);
                    $navigations .= Response::view('admin.interface.nav-li', $data )->getOriginalContent();
                }
            }
        }*/

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