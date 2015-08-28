<?php

namespace Dynamix\Models;

use Illuminate\Database\Eloquent\Model;

class BackgroundType extends Model {
	
	/**
	 * Parameters
	 */
	protected $table = 'background_types';


	/**
	 * Relations
	 *
	 * @var string
	 */
    public function background()
    {
    	return $this->hasMany('Dynamix\Models\Background');
	}
}