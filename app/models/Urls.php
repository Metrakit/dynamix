<?php

class Urls extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'urls';
    public $timestamps = false;

   	/**
     * An Url has one i18n
     *
     * @return mixed
     */
	public function i18n() {
        return $this->hasOne('I18n');
    }

    /**
     * An Url has one locale
     *
     * @return mixed
     */
    public function locale() {
        return $this->hasOne('Locale');
    }

    /**
     * Additional methods
     *
     * @return mixed
     */
    public static function getRoutes () {
        $cachePrefix = 'Urls::getRoutes';
        if (Cache::has($cachePrefix)) {
            return Cache::get($cachePrefix);
        }
        $data = DB::select('
                SELECT translations.i18n_id , translations.text , translations.locale_id 
                FROM translations
                INNER JOIN i18n_types ON i18n_types.name = ?
                INNER JOIN i18n ON i18n.i18n_type_id = i18n_types.id AND translations.i18n_id = i18n.id
            ', array('url'));
        //$data = Translation::i18n()->where('i18n_type_id','=',I18nType::where('name','=','url')->first()->id)->get
        $datas = array();
        foreach( $data as $d )
        {   
            $datas[] = array( 'i18n_id'     => $d->i18n_id,
                              'url'         => $d->text,
                              'locale_id'   => $d->locale_id );
        }
        Cache::put($cachePrefix, $datas, 60);
        return $datas;
    }

}