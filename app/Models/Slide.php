<?php

namespace Dynamix\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model {
    
	/**
     * Parameters
     */
    protected $table = 'slides';
    
    /**
     * Relations
     *
     * @return mixed
     */
    public function slider() 
    {
        return $this->belongsTo('Dynamix\Models\Slider');
    }

    public function image() 
    {
        return $this->belongsTo('Dynamix\Models\Image');
    }
    
    /**
     * Polymorphic Relations
     *
     * @return mixed
     */
    public function trackable() 
    {
        return $this->morphTo();
    }
}