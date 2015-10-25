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
        return substr(Config::get('app.url'), 7);
    }

    public static function autoResponse ($url = 'back', $statut = 'error', $message = '', $options = array()) {
        if (Request::ajax()) {
            $data = array();
            // Options
            if (!empty($options)) $data = $options;
            // Statut
            if ($statut == 'error') $statut = 'danger';
            $data['statut'] = $statut;
            $data['message'] = $message;
            // Response
            return Response::json($data);
        } else {
            if ($url == 'back') {
                if ($statut == 'validator') {
                    return Redirect::back()->withInput()->withErrors($message);
                } else {
                    return Redirect::back()->with($statut, $message);
                }
            } else {
                if ($statut == 'validator') {
                    return Redirect::to($url)->withInput()->withErrors($message);
                } else {
                    return Redirect::to($url)->with($statut, $message);
                }
            }
        }
    }
}
