<?php

class Tag extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tags';

	/**
     * An Tag has belong to many Post
     *
     * @return mixed
     */
	public function posts() {
        return $this->belongsToMany('Post');
    }
}