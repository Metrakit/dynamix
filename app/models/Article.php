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
        return $this->morphMany('Nav', 'navigable');
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
	public function translate( $i18n_id )
	{
		return Translation::where('i18n_id','=',$i18n_id)->where('locale_id','=',App::getLocale())->first()->text;
	}


    /**
     * Attributes
     *
     * @return mixed
     */
	public function content()
	{
		return $this->translate( $this->i18n_content );
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
























	/**
	 * Get the article's author.
	 *
	 * @return User
	 */
	/*public function author()
	{
		//return $this->belongsTo('User', 'user_id');
		$user = User::find($this->user_id);
		if(empty($user) || !isset($user)) {
			return 'Anonyme';
		}
		return $user->pseudo;
	}*/
	
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
