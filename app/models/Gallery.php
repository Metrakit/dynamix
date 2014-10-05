<?php

class Gallery extends Eloquent
{
	/**
     * Parameters
     */    
	protected $table = 'galleries';


    /**
     * Attributes for construct a form
     * @return Array
     */
    public static function formr()
    {
        return array(        
            'type'  => 'normal',
            'data'  => array(
                'title' => array(
                    'type'        => 'text',
                    'rules'       => 'required',
                    'placeholder' => Lang::get('input.gallery.title.placeholder'),
                    'helper'      => Lang::get('input.gallery.title.helper'),
                    'label'       => Lang::get('input.gallery.title.label'),
                ),
                'description' => array(
                    'type'        => 'textarea',
                    'rules'       => 'required',
                    'placeholder' => Lang::get('input.gallery.description.placeholder'),
                    'helper'      => Lang::get('input.gallery.description.helper'),
                    'label'       => Lang::get('input.gallery.description.label'),
                ),
            ),
            'method' => 'model',
            'model' => get_class(),
        );
    }

    /**
     * Formr action
     * @param  Array $inputs
     */
    public static function getForm($inputs)
    {
        Log::info('Form inputs:');
        Log::info($inputs);
    }


	/**
     * Relations
     *
     * @var string
     */   
    public function mosaique() {
        return $this->belongsTo('Mosaique');
    }

    public function images() {
        return $this->belongsToMany('Image');
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
    public function translate( $i18n_id ) {
        return Translation::where('i18n_id','=',$i18n_id)->where('locale_id','=',App::getLocale())->first()->text;
    }

    public function cover() {
        return Image::find($this->cover_id)->getThumb();
    }
    
    public function getUrlCover() {
        return Image::find($this->cover_id)->getImage();
    }
    
    public function hasMosaique() {
        return ( $this->mosaique_id == null ? false : true );
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