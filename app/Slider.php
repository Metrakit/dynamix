<?php

class Slider extends Eloquent
{
	/**
     * Parameters
     */
    protected $table = 'sliders';


    /**
     * Relations
     *
     * @return mixed
     */
    public function slides() {
        return $this->hasMany('Slide');
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
     * Additional Method
     *
     * @var string
     */

}