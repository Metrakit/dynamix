<?php

class Mosaic extends Eloquent
{
	/**
     * Parameters
     */
	protected $table = 'mosaics';

	/**
     * Relations
     *
     * @var string
     */
    public function galleries() {
        return $this->belongsToMany('Gallery');
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
}