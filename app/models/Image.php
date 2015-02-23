<?php

class Image extends Eloquent{
	
	/**
	 * Parameters
	 */
	protected $table = 'images';
	protected $fillable = ['i18n_description', 'file_name', 'file_ext'];

	/**
	 * Relation
	 *
	 * @var string
	 */


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
}