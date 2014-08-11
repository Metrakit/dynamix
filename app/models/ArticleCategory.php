<?php

class ArticleCategory extends Eloquent{

	/**
	 * Parameters
	 */
	protected $table = 'article_categories';


	/**
	 * Relations
	 *
	 * @var string
	 */
	public function articles() {
        return $this->belongsToMany('Article');
    }

	public function structure() {
        return $this->hasOne('Structure');
    }


    /**
	 * Polymorphic relation
	 *
	 * @var string
	 */	
    public function navigation()
    {
        return $this->morphMany('Nav', 'naviggable');
    }
    

	/**
	 * Attributes
	 *
	 * @var string
	 */
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