<?php

namespace Dynamix\Models;

class Article extends Model {

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
        return $this->hasOne('Dynamix\Models\User');
    }

	public function blogs() {
        return $this->belongsToMany('Dynamix\Models\Blog');
    }

	public function categories() {
        return $this->belongsToMany('Dynamix\Models\ArticleCategory');
    }

	public function tags() {
        return $this->belongsToMany('Dynamix\Models\Tag');
    }

	
	/**
	 * Polymorphic relation
	 *
	 * @var string
	 */
	public function structure()
    {
        return $this->morphMany('Dynamix\Models\Structure', 'structurable');
    }

    public function navigation()
    {
        return $this->morphMany('Dynamix\Models\Nav', 'navigable');
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



    /**
     * Attributes
     *
     * @return mixed
     */
	public function content()
	{
		return \Eloquentizr::getTranslation( $this->i18n_content );
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
