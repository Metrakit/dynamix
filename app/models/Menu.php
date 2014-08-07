<?php

class Menu extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'menus';

	/**
     * A Menu hasOne resource
     *
     * @return mixed
     */
	public function resource() {
        return $this->hasOne('Resource');
    }

	/**
     * get all children for a menu
     *
     * @return mixed
     */
	public function children() {
        return Menu::where('parent_id','=',$this->id)->orderBy('order','ASC')->get();
    }



	
	/**
     * i18n Title
     *
     * @return mixed
     */
	public function i18n_title(){
		return Translation::where('i18n_id','=',$this->i18n_title)
						  ->where('locale_id','=',App::getLocale())
						  ->first()
						  ->text;
	}

	/**
     * Get Url of dynamix Element
     *
     * @return mixed
     */
	public function url(){
		$resource_id 	= $this->resource_id;
		$url 			= null;

		switch ( $resource_id ) {
		    case 1://Category
		    	$url = Category::find($this->element_id)->i18n_url();
		        break;
		    case 2://Post
		    	$url = Post::find($this->element_id)->i18n_url();
		        break;
		    case 4://Page
		    	$url = Page::find($this->element_id)->i18n_url();
		        break;
		    case 6://LinkContainer
		    	$url = '#';
		        break;
		}

		if($url !== null){
			return $url;
		}
	}




}