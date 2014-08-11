<?php

class Article extends Eloquent {

	/**
	 * Parameters
	 */
	protected $table = 'articles';


	/**
	 * Relations
	 *
	 * @var string
	 */
	public function user() {
        return $this->hasOne('User');
    }

	public function blogs() {
        return $this->belongsToMany('Blog');
    }

	public function categories() {
        return $this->belongsToMany('ArticleCategory');
    }

	public function tags() {
        return $this->belongsToMany('Tag');
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
     * @return mixed
     */
	public function i18n_title()
	{
		return Translation::where('i18n_id','=',$this->i18n_title)->where('locale_id','=',App::getLocale())->first()->text;
	}

	public function i18n_url()
	{
		return Urls::where('i18n_id','=',$this->i18n_url)->where('locale_id','=',App::getLocale())->first()->text;
	}

	public function i18n_content()
	{
		return Translation::where('i18n_id','=',$this->i18n_content)->where('locale_id','=',App::getLocale())->first()->text;
	}

	public function i18n_meta_title()
	{
		return Translation::where('i18n_id','=',$this->i18n_meta_title)->where('locale_id','=',App::getLocale())->first()->text;
	}

	public function i18n_meta_description()
	{
		return Translation::where('i18n_id','=',$this->i18n_meta_description)->where('locale_id','=',App::getLocale())->first()->text;
	}

	public function i18n_meta_keywords()
	{
		return Translation::where('i18n_id','=',$this->i18n_meta_keywords)->where('locale_id','=',App::getLocale())->first()->text;
	}




	/**
	 * Get the article's author.
	 *
	 * @return User
	 */
	public function author()
	{
		//return $this->belongsTo('User', 'user_id');
		$user = User::find($this->user_id);
		if(empty($user) || !isset($user)) {
			return 'Anonyme';
		}
		return $user->pseudo;
	}
	
	/**
	 * Return the date in the locale format
	 *
	 * @return string
	 */
	public function date( $date = null, $format = null )
	{
		if( $date === null ){
			return 'null';
		}else{
			$date = new DateTime( $date, new DateTimeZone( Config::get('app.timezone') ) );
			return $date->format( ( $format === null ? Config::get('app.timeformatfull') : $format ) );
		}
	}

	/**
	 * Returns the date of the blog article creation,
	 * on a good and more readable format :)
	 *
	 * @return string
	 */
	public function created_at()
	{
		return $this->date($this->created_at ,Config::get('app.timeformatnormal'));
	}


	/**
	 * Returns the date of the blog article last update,
	 * on a good and more readable format :)
	 *
	 * @return string
	 */
	public function updated_at()
	{
        return $this->date($this->updated_at ,Config::get('app.timeformatnormal'));
	}


	/**
	 * Deletes a blog article and all
	 * the associated comments.
	 *
	 * @return bool
	 */
	public function delete()
	{
		// Delete the comments
		$this->comments()->delete();

		// Delete the blog article
		return parent::delete();
	}
}
