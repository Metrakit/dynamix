<?php

class Locale extends Eloquent{

	/**
	 * Parameters
	 *
	 */
	protected $table = 'locales';
	public $timestamps = false;


	/**
     * Relations
     *
     * @return mixed
     */
	public function translations() {
        return $this->hasMany('Translation');
    }


    /**
     * Aditional method
     *
     */
    public function tags() {
    	return DB::table('tags')
        ->join('translations', function($join)
        {
            $join->on('tags.i18n_name', '=', 'translations.i18n_id');
        })
        ->where('translations.locale_id','=',$this->id)
        ->orderBy('translations.text','ASC')
        ->get(array('tags.id','text'));
	}
}