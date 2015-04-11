<?php

class Helper {
   /**
     * Change keys in object with a specific value
     * @param  Object $object
     * @param  String  $key 
     * @return  Array
     */
    public static function changeKeysInObject($object, $newKey)
    {
        if (!is_object($object) || !sizeof($object)) {
            throw new Exception("The object indicated in the function `" . get_class() . "@" . debug_backtrace()[0]['function'] ."` isnt valid", 1);
        }
        if ($newKey === NULL) {
            throw new Exception("The new key in the function `" . get_class() . "@" . debug_backtrace()[0]['function'] ."` isnt valid", 1);
        }        
        $data = array();
        foreach ($object as $value) {
            $data[$value[$newKey]] = $value;
        }
        return $data;
    }

    public static function getDomain()
    {
        Route::pattern('top', '^((?!www).)*$');

        return substr(Config::get('app.url'), 7);
    }

}
