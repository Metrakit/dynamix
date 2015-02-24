<?php

class Tag extends Eloquent{
	
	/**
	 * Parameters
	 */
	protected $table = 'tags';
	public static $langNav = 'admin.nav_tag';

	/**
	 * Relations
	 *
	 * @var string
	 */
	
	/**
	 * Polymorphic relation
	 *
	 * @var string
	 */
	public function pages () {
		return $this->morphedByMany('Page', 'taggable');
	}

 	
 	/**
     * Additional method
     *
     * For TagController::delete()
     * @return mixed
     */
 	public function i18n () {
 		return I18n::find($this->i18n_name);
 	}

 	public function taggables () {
		return Taggable::where('tag_id','=', $this->id)->get();
	}

	public function translateLocale( $i18n_id, $locale_id ) {
		return Translation::where('i18n_id','=',$i18n_id)->where('locale_id','=', $locale_id)->first()->text;
	}
	
	public function tag_name_locale( $locale_id ) {
		return $this->translateLocale( $this->i18n_name, $locale_id );
	}


}