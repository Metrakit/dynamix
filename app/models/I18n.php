<?php

class I18n extends Eloquent{
	
    /**
     * Parameters
     */
	protected $table = 'i18n';
    public $timestamps = false;
    protected $fillable = ['i18n_type_id'];

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


    public static function add($data, $type)
    {

        if (!is_array($data)) {
            throw new InvalidArgumentException('The array $data should be an array with lang ids !', 1);          
        }

        $i18nType = I18nType::where('name', $type)
                            ->first();
        if (!$i18nType) {
            return false;
        }                    

        $i18n = new self;
        $i18n->i18n_type_id = $i18nType->id;
        $i18n->save();

        foreach ($data as $lang => $value) {
           Translation::add($i18n->id, $lang, $value); 
        }

        Log::info($i18n->id);

        return $i18n->id;
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
    
    public function updateText( $locale_id, $newText ) {
        $translation = Translation::where( 'i18n_id', '=', $this->id )->where( 'locale_id', '=', $locale_id )->first() ;

        if ( !empty($translation) ) {
            $translation->text = $newText;
            if ( $translation->save() ) {
                return true;
            }
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