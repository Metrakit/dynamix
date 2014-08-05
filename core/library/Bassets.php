<?php

class Bassets {

    public static function show( $url_key ) {
    	//Cache
	    //$json = Cache::remember('assetsConfig', 262800 /*6mois*/, function()
	    //{
			$fcontent = null;
		    try{
				//Lecture du fichier
			    $fcontent = file_get_contents ('../app/config/assets/assets.json');  
				$json = json_decode ($fcontent);
				$json = (array) $json;
		    } catch (Exception $e) {
			    //echo 'Exception reçue : ',  $e->getMessage(), "\n";
			}
	    //});
    	//retourne la valeur de la clé, si elle existe, passé en params!
    	if(isset($json[$url_key])){
    		echo $json[$url_key];
    	}else{
    		echo 'error_assets';
    	}
    }

}