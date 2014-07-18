<?php

class Tag extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tags';

	/**
     * An Tag has belong to many article
     *
     * @return mixed
     */
	public function articles() {
        return $this->belongsToMany('Article');
    }
}