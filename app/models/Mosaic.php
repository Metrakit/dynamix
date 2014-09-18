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


    /**
     * Polymorphic relation
     *
     * @var string
     */
    public function structure()
    {
        return $this->morphMany('Structure', 'structurable');
    }

    public function navigation()
    {
        return $this->morphMany('Nav', 'naviggable');
    }

    public function trackable()
    {
        return $this->morphTo();
    }


    /**
     * Additional Method
     *
     * @var string
     */
    public function translate( $i18n_id )
    {
        return Translation::where('i18n_id','=',$i18n_id)->where('locale_id','=',App::getLocale())->first()->text;
    }


    /**
     * Attributes
     *
     * @return mixed
     */
    public function description()
    {
        return $this->translate( $this->i18n_description );
    }

  
    /**
     * Herited attributes
     *
     * @return mixed
     */
    public function title()
    {
        return $this->structure->first()->title();
    }

    public function url()
    {
        return $this->structure->first()->url();
    }

    public function meta_title()
    {
        return $this->structure->first()->meta_title();
    }

    public function meta_description()
    {
        return $this->structure->first()->meta_description();
    }  
}