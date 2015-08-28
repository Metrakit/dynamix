<?php

namespace Dynamix\Models;

use Illuminate\Database\Eloquent\Model;xml_set_start_namespace_decl_handler(parser, handler)

class Permission extends Eloquent
{
    /**
     * Parameters
     */
	protected $table = 'permissions';
    public $timestamps = false;
    protected $fillable = ['role_id', 'type', 'action_id', 'resource_id'];

    /**
     * Relations
     *
     * @var string
     */
	public function role() 
    {
        return $this->belongsTo('Dynamix\Models\Role');
    }

    public function action() 
    {
        return $this->hasOne('Dynamix\Models\Action');
    }

    public function resource() 
    {
        return $this->belongsTo('Dynamix\Models\Resource');
    }

    /**
     * Polymorphic relation
     *
     * @var string
     */
    public function trackable() 
    {
        return $this->morphTo();
    }

    /**
     * Additionnal method
     *
     * @var string
     */

}