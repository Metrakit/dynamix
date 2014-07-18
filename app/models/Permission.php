<?php

class Permission extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'permissions';

	/**
     * A permission have one Role
     *
     * @return mixed
     */
	public function role() {
        return $this->hasOne('Role');
    }

    /**
     * A permission have one Action
     *
     * @return mixed
     */
    public function action() {
        return $this->hasOne('Action');
    }

    /**
     * A permission have one Resource
     *
     * @return mixed
     */
    public function resource() {
        return $this->hasOne('Resource');
    }
}