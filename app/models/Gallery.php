<?php

class Gallery extends Eloquent
{
	/**
     * Parameters
     */    
	protected $table = 'galleries';
    

    
    public static function formParams()
    {
        return array(        
            'type'  => 'normal',
            'title' => Lang::get('form.gallery.title'),
            'description' => Lang::get('form.gallery.description'),
            'data'  => array(
                'title' => array(
                    'name'        => 'title',
                    'type'        => 'text',
                    'rules'       => 'required',
                    'viewPath'        => 'public.form.input.text',
                    'title'       => Lang::get('input.gallery.title.title'),
                    'placeholder' => Lang::get('input.gallery.title.placeholder'),
                    'helper'      => Lang::get('input.gallery.title.helper'),
                    'label'       => Lang::get('input.gallery.title.label'),
                ),
                'description' => array(
                    'name'        => 'description',
                    'type'        => 'textarea',
                    'rules'       => 'required',
                    'viewPath'        => 'public.form.input.textarea',
                    'title'       => Lang::get('input.gallery.description.title'),
                    'placeholder' => Lang::get('input.gallery.description.placeholder'),
                    'helper'      => Lang::get('input.gallery.description.helper'),
                    'label'       => Lang::get('input.gallery.description.label'),
                ),
                'type' => array(
                    'name'        => 'type',
                    'type'        => 'select',
                    'rules'       => 'required',
                    'viewPath'        => 'public.form.input.select',
                    'options'     => array(
                        array(
                            'key'   => Lang::get('input.gallery.type.key.1'),
                            'value' => Lang::get('input.gallery.type.key.3'),
                        ),
                        array(
                            'key'   => Lang::get('input.gallery.type.value.2'),
                            'value' => Lang::get('input.gallery.type.value.3'),
                        ), 
                        array(
                            'key'   => Lang::get('input.gallery.type.value.3'),
                            'value' => Lang::get('input.gallery.type.value.3'),
                        ),                       
                    ),
                    'title'       => Lang::get('input.gallery.description.title'),
                    'placeholder' => Lang::get('input.gallery.description.placeholder'),
                    'helper'      => Lang::get('input.gallery.description.helper'),
                    'label'       => Lang::get('input.gallery.description.label'),
                ),
                'envoyer' => array(
                    'name'        => 'envoyer',
                    'type'        => 'submit',
                    'rules'       => 'required',
                    'viewPath'        => 'public.form.input.submit',
                    'title'       => Lang::get('input.gallery.description.title'),
                    'placeholder' => Lang::get('input.gallery.description.placeholder'),
                    'helper'      => Lang::get('input.gallery.description.helper'),
                    'label'       => Lang::get('input.gallery.description.label'),
                ),
            ),
            'method' => 'model',
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