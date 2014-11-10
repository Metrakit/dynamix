<?php

class Tag extends Eloquent{
	
	/**
	 * Parameters
	 */
	protected $table = 'tags';

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


}