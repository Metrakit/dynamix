<?php

class Permission extends Eloquent
{
    /**
     * Parameters
     */
	protected $table = 'permissions';
    public $timestamps = false;

    /**
     * Relations
     *
     * @var string
     */
	public function role() {
        return $this->belongsTo('Role');
    }

    public function action() {
        return $this->hasOne('Action');
    }

    public function resource() {
        return $this->belongsTo('Resource');
    }

    /**
     * Polymorphic relation
     *
     * @var string
     */
    public function trackable() {
        return $this->morphTo();
    }


    /**
     * Additionnal method
     *
     * @var string
     */

}