<?php

namespace Dynamix\Models;

/**
 * Use to manage simple module for rendering in Block
 */
class Module extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table              = 'modules';
    public $timestamps            = false;
    public static $blockable_type = 'Module';

    /**
     * #Pager method
     *
     * @return mixed
     */
    public function renderResource($locale_id)
    {
        $model_name = $this->target_model;
        return $model_name::deployResource($locale_id);
    }
}