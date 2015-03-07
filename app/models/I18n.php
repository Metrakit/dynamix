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


    /**
     * Add a new text with translations
     * @param Array $data Langs array
     * @param String $type i18n type
     */
    public static function add($data, $type, $key = null)
    {

        if (!is_array($data)) {
            throw new InvalidArgumentException('The array $data should be an array with lang ids !', 1);          
        }

        $i18nType = I18nType::where('name', $type)
                            ->first();
        if (!$i18nType) {
            return FALSE;
        }                    

        $i18n = new self;
        $i18n->i18n_type_id = $i18nType->id;

        if ($key !== null) $i18n->key = $key;
        
        $i18n->save();

        foreach ($data as $lang => $value) {
           Translation::add($i18n->id, $lang, $value); 
        }

        return $i18n->id;
    }

     /**
     * Get translations of a Text
     * @param  integer $id i18n Id
     * @return array texts translated
     */
    public static function read($id)
    {

        if (!is_integer($id)) {
            throw new InvalidArgumentException('$id should be an integer !', 1);          
        }     

        $i18n = self::find($id);
        if (!$i18n) {
            return NULL;
        }    
        
        return Translation::getByI18n($i18n->id);
    }   

    /**
     * Update translations of a Text
     * @param  integer $id i18n Id
     * @param  array $data A list of texts translated
     * @return array new texts translated
     */
    public static function change($id, $data)
    {

        if (!is_integer($id)) {
            throw new InvalidArgumentException('$id should be an integer !', 1);          
        }     

        if (!is_array($data) || !sizeof($data)) {
            throw new InvalidArgumentException('The array $data should be an array with lang ids and should not be empty !', 1);          
        }    

        $i18n = self::find($id);
        if (!$i18n) {
            throw new UnexpectedValueException('$i18n not found !', 1);
        }    

        $texts = array();

        foreach ($data as $lang => $value) {
           $text = Translation::change($i18n->id, $lang, $value);
           if ($text) {
                $texts[$lang] = $text;
           }
        }

        // return an Array of the new texts translated
        if (sizeof($texts)) {
            return $texts;
        }

        return NULL;
    }

    /**
     * Delete text with translations
     * @param  integer $id i18n Id
     * @return boolean
     */
    public static function remove($id)
    {

        if (!is_integer($id)) {
            throw new InvalidArgumentException('$id should be an integer !', 1);          
        }         

        $i18n = self::find($id);
        if (!$i18n) {
            throw new UnexpectedValueException('$i18n not found !', 1);
        }    

        Translation::removeFromI18n($id);

        // Try to delete it if not foreign keys are founded
        try {
            return $i18n->delete();
        } catch (Exception $e) {
            throw new Exception("You cannot delete this i18n: " . $e->getMessage(), 1);           
        }
    }

    /**
     * Get shortcut for constants translations
     * @param  integer $id i18n Id
     * @return boolean
     */
    public static function get($key)
    {

        if (!is_string($key)) {
            throw new InvalidArgumentException('$key should be a string !', 1);          
        }         

        $i18n = self::where('key', $key)->first();
        if (!$i18n) {
            return false;
            Log::error('$i18n not found !');
        }
        
        $locale = Translation::where('i18n_id', $i18n->id)->where('locale_id', App::getLocale())->first();
        if (!$locale) {
            return $key;
            Log::error('$locale not found !');
        }

        // Try to delete it if not foreign keys are founded
        try {
            return ($locale->text==''?$key:$locale->text);
        } catch (Exception $e) {
            Log::error("You cannot get this i18n: " . $e->getMessage(), 1);        
        }
    }


    /**
     * Additional Method
     *
     * @var string
     */
	public function translate( $locale_id, $text ) {
        if( Translation::add( $this->id, $locale_id, $text ) ) {
            return true;
        }
        return false;
    }
    
    public function updateText( $locale_id, $newText ) {
        $translation = Translation::where( 'i18n_id', '=', $this->id )->where( 'locale_id', '=', $locale_id )->first();

        if ( !empty($translation) ) {
            $translation->text = $newText;
            if ( $translation->save() ) {
                return true;
            }
        }
        return false;
    }

    public function getLocale( $locale_id )
    {
        return Translation::where('i18n_id','=',$this->id)->where('locale_id','=', $locale_id)->first()->text;
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