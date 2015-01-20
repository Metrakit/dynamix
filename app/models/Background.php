<?php

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
        return $this->hasMany('Part');
    }

    public function background_type()
    {
    	return $this->hasOne('BackgroundType', 'id');
	}

	public function background_position()
    {
    	return $this->hasOne('BackgroundPosition', 'id');
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
		return (empty($this->background_type()->where('name', 'image')->first())?false:true);
	}
	public function is_fixed () {
		return true;
		//and the second is : relative
		return (empty($this->background_position()->where('name', 'fixed')->first())?false:true);
	}
	
}