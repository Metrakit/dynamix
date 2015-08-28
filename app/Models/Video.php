<?php

namespace Dynamix\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model {
	
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
	public function getThumb () 
	{
        return 'http://i1.ytimg.com/vi/' . $this->code . '/default.jpg';
    }

	public function getVideo () 
	{
        return '//www.youtube.com/embed/' . $this->code;
    }
}