<?php

class ArticleCategory extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'article_categories';

	/**
     * A Category is on many Posts
     *
     * @return mixed
     */
	public function posts() {
        return $this->belongsToMany('Post');
    }


	public function i18n_url()
	{
		return Urls::where('i18n_id','=',$this->i18n_url)
				   ->where('locale_id','=',App::getLocale())
				   ->first()
				   ->text;
	}

	public function i18n_title()
	{
		return Translation::where('i18n_id','=',$this->i18n_title)
						  ->where('locale_id','=',App::getLocale())
						  ->first()
						  ->text;
	}
	
	public function i18n_meta_title()
	{
		return Translation::where('i18n_id','=',$this->i18n_meta_title)
						  ->where('locale_id','=',App::getLocale())
						  ->first()
						  ->text;
	}

	public function i18n_meta_description()
	{
		return Translation::where('i18n_id','=',$this->i18n_meta_description)
						  ->where('locale_id','=',App::getLocale())
						  ->first()
						  ->text;
	}

	public function i18n_meta_keywords()
	{
		return Translation::where('i18n_id','=',$this->i18n_meta_keywords)
						  ->where('locale_id','=',App::getLocale())
						  ->first()
						  ->text;
	}
}