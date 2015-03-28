<?php

class Locale extends Eloquent{

	/**
	 * Parameters
	 *
	 */
	protected $table = 'locales';
	public $timestamps = false;


	/**
     * Relations
     *
     * @return mixed
     */
	public function translations() {
        return $this->hasMany('Translation');
    }


    /**
     * Aditional method
     *
     */
    public function tags() {
        $data = DB::table('tags')
        ->join('translations', function($join)
        {
            $join->on('tags.i18n_name', '=', 'translations.i18n_id');
        })
        ->where('translations.locale_id','=',$this->id)
        ->orderBy('translations.text','ASC')
        ->get(array('tags.id','text'));

        //Log::info(print_r(DB::getQueryLog()));

        return $data;
	}

    /**
     * Count the active locales
     *
     */
    public static function countEnable($clear = false)
    {
        if ($clear) {
            Cache::forget('count_enable_locales');
        }
        return Cache::rememberForever('count_enable_locales', function() {
            return self::where('enable', true)->count();
        });
    }

}