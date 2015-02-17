<?php

class Image extends Eloquent{
	
	/**
	 * Parameters
	 */
	protected $table = 'images';

	/**
	 * Relation
	 *
	 * @var string
	 */
	public function gallery () {
        return $this->belongsTo('Gallery');
    }

    public function scopeOrderAsc ($query) {
        return $query->orderBy('order','ASC');
    } 

	/**
	 * Additional Method
	 *
	 * @var string
	 */	
	public function translate( $i18n_id ) {
        return Translation::where('i18n_id','=',$i18n_id)->where('locale_id','=',App::getLocale())->first()->text;
    }

	public function getThumb () {
        return asset('/uploads_thumbs/' . $this->file_name . '.' . $this->file_ext);
    }

	public function getImage () {
        return asset('/uploads/' . $this->file_name . '.' . $this->file_ext);
    }

    public function description () {
        return $this->translate($this->i18n_description);
    }

    public function getMaxOrder () {
        return Image::where('gallery_id','=',$this->gallery_id)->max('order');
    }
}