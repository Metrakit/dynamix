<?php

class Slide extends Eloquent
{
	/**
     * Parameters
     */
    protected $table = 'slides';

    
    /**
     * Relations
     *
     * @return mixed
     */
    public function slider() {
        return $this->belongsTo('Slider');
    }

    public function image() {
        return $this->belongsTo('Image');
    }
    
    /**
     * Polymorphic Relations
     *
     * @return mixed
     */
    public function trackable() {
        return $this->morphTo();
    }
}