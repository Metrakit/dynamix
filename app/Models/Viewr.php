<?php

namespace Dynamix\Models;

use Illuminate\Database\Eloquent\Model;

class Viewr extends Model {
	
	protected $table = "views";
	protected $fillable = ['name', 'path'];

}