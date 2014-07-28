<?php

class I18n extends Eloquent{
	
    /**
     * Parameters
     */
	protected $table = 'i18n';
    public $timestamps = false;

	/**
     * Relations
     *
     * @var string
     */
    public function translations() {
        return $this->hasMany('Translation');
    }

    public function types() {
        return $this->hasOne('I18nType');
    }



    /**
     * Additional Method
     *
     * @var string
     */
	public function translate( $locale_id, $text ) {
        if( Translation::create( array('i18n_id' => $this->id, 'locale_id' => $locale_id, 'text' => $text ) ) ){
            return true;
        }
        return false;
    }

    /*public static function urls() {   DONT WORK
        $instance = new static;

        $instance->join('i18n_types', function($join)
            {
                $join->on('i18n_types.id', '=', 'i18n.i18n_type_id')
                     ->where('i18n_types.name', '=', 'url');
            })
            ->join('translations', 'translations.i18n_id', '=', 'i18n.id');

        return $instance;
    }*/
}