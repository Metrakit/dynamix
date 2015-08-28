<?php

namespace Dynamix\Models;

class Slider extends Eloquent {

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