<?php

class Gallery extends Eloquent
{
	/**
     * Parameters
     */    
	protected $table = 'galleries';


	/**
     * Relations
     *
     * @var string
     */    
    public function images() {
        return $this->belongsToMany('Image');
    }

    public function structure() {
        return $this->hasOne('Structure');
    }

    
    /**
     * Polymorphic relation
     *
     * @var string
     */
    public function navigation()
    {
        return $this->morphMany('Nav', 'naviggable');
    }


    /**
     * Attributes
     *
     * @return mixed
     */
}