<?php

class Permission extends Eloquent
{
    /**
     * Parameters
     */
	protected $table = 'permissions';


    /**
     * Relations
     *
     * @var string
     */
	public function role() {
        return $this->hasOne('Role');
    }

    public function action() {
        return $this->hasOne('Action');
    }

    public function resource() {
        return $this->hasOne('Resource');
    }

    /**
     * Polymorphic relation
     *
     * @var string
     */
    public function trackable() {
        return $this->morphTo();
    }
}