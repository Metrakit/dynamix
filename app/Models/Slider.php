<?php

namespace Dynamix\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model {

	/**
     * Parameters
     */
    protected $table = 'sliders';

    /**
     * Relations
     *
     * @return mixed
     */
    public function slides()
    {
        return $this->hasMany('Dynamix\Models\Slide');
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
     * Additional Method
     *
     * @var string
     */

}