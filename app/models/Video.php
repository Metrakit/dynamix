<?php

class Video extends Eloquent{
	
	/**
	 * Parameters
	 */
	protected $table = 'videos';
	protected $fillable = ['code'];

	/**
	 * Relation
	 *
	 * @var string
	 */


	/**
	 * Additional Method
	 *
	 * @var string
	 */	
	public function getThumb () {
        return 'http://i1.ytimg.com/vi/' . $this->code . '/default.jpg';
    }

	public function getVideo () {
        return '//www.youtube.com/embed/' . $this->code;
    }
}