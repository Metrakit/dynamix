<?php

class Blog extends Eloquent{
	
    /**
     * Parameters
     */
	protected $table = 'blogs';

	/**
     * Relations
     *
     * @var string
     */
	public function articles() {
        return $this->belongsToMany('Article');
    }

	public function structure() {
        return $this->belongsToMany('Structure');
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