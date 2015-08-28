<?php

namespace Dynamix\Models;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

use Dynamix\Models\Action;
use Dynamix\Models\Resource;
use Dynamix\Models\AdminNavigationGroup;

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
    public function roles() 
    {
        return $this->belongsToMany('Dynamix\Models\Role', 'auth_role', 'auth_id', 'role_id');
    }

    public function tracks() 
    {
        return $this->hasMany('Dynamix\Models\Track');
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
    public static function add ($email, $password) 
    {
        $auth = new self;
        $auth->email = $email;
        $auth->password = \Hash::make($password);
        if ($auth->save()) {
            return $auth;
        }
        return false;
    }

    public function remove () 
    {
        foreach ($this->roles() as $role) {
            if (!$role->delete()) return false;
        }
        return true;
    }

    public function getAuthorizedNavigations () 
    {
        $resources = array();
        $navigations = '';

        foreach ($this->roles as $role) {
            foreach ($role->permissions as $permission) {
                $resources[] = $permission->resource_id;
            }
        }

        $resources = array_unique($resources);

        // Get all resource in the good group
        $data_by_group = array();
        foreach ( AdminNavigationGroup::allCached() as $group) {
            foreach ( $resources as $resource_id ) {
                $resource = Resource::findCached($resource_id);
                if ($resource->in_admin_ui == 1) {                    
                    if ($resource->admin_navigation_group_id == $group->id) $data_by_group['group:' . $group->id][] = $resource;
                }
            }
        }

        //return var_dump($data_by_group);

        //Make data
        $data_temp = array();
        // Pu in the root of array, well resources
        $data_temp = $data_by_group['group:1'];
        // Dispatch other
        foreach ($data_by_group as $groupKey => $groupValue) {
            if ($groupKey != 'group:1') {
                $data_temp[] = $data_by_group[$groupKey];
            }
        }


        //Make Navigation with dropdown
        //$navigations .= Response::view('theme::admin.interface.nav-li', $data )->getOriginalContent();
        $i = 1;
        foreach ($data_temp as $objectKey => $objectValue) {

            if (gettype($objectValue) == "object") {
                // Add directly to ul(s)
                $navigations .= self::getResponseAdminLi($objectValue);
            } else if (gettype($objectValue) == "array") {
                //drop down bitch
                $navigations_temp = '';
                foreach ($objectValue as $resource) {                
                    if(gettype($resource) == "object") {
                        $navigations_temp .= self::getResponseAdminLi($resource);
                    }
                }
                $dataDropdown['groupKey'] = $objectKey;
                $dataDropdown['lang'] = config('admin.nav_admin.groups.group' . $i);
                $dataDropdown['lis'] = $navigations_temp;
                $navigations .= \Response::view('theme::admin.interface.nav-dropdown', $dataDropdown )->getOriginalContent();
                $i++;
            }
        }

        return $navigations;
    }

    public static function getResponseAdminLi ($object) 
    {
        $model_name = ucfirst ($object->model);
        $lang = ($object->model!=''?$model_name::$langNav:'admin.nav_' . $object->name);
        $data = array(
                'name'  => $object->name,
                'lang'  => $lang,
                'icon'  => $object->icon);
        return \Response::view('theme::admin.interface.nav-li', $data )->getOriginalContent();
    }

    public function rolesList () 
    {
        $str = '';
        foreach ( $this->roles as $role ) {
            $str .= ' '.$role->name.',';
        }
        return mb_substr ($str, 1, strlen($str) - 2);
    }
}