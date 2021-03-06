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
}