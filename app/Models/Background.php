<?php

namespace Dynamix\Models;

class Background extends Eloquent{
	
	/**
	 * Parameters
	 */
	protected $table = 'backgrounds';


	/**
	 * Relations
	 *
	 * @var string
	 */
	public function parts() {
        return $this->hasMany('Dynamix\Models\Page');
    }

    public function background_type() {
    	return $this->hasOne('Dynamix\Models\BackgroundType', 'id');
	}

	public function background_position()
    {
    	return $this->hasOne('Dynamix\Models\BackgroundPosition', 'id');
	}

	public function image_data () {
		if (file_exists($this->url)) {
			//image find !
			return 'data: '.(function_exists('mime_content_type') ? mime_content_type($this->url) : $mime).';base64,'.base64_encode(file_get_contents($this->url));
		} else {
			//image not find
			return '';
		}
	}

	public function is_image () {
		//video too
		$type = BackgroundType::find($this->background_type_id);
		if ($type->name == 'image') {
			return true;
		}
		return false;
	}
	public function is_fixed () {
		$type = BackgroundPosition::find($this->background_position_id);
		if ($type->name == 'fixed') {
			return true;
		}
		return false;
	}
	
}