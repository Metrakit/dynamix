<?php

class Bassets {

    public static function show( $urlKey ) {
    	//Récupération de tous les fichiers .json (theme.json)
    	$themesHash = app_path() . '/config/assets/theme/';
    	$pathForAssets = 'theme/';

    	try{
			$dir = opendir($themesHash); 
			$themesFile = array();
			while($file = readdir($dir)) {
				if($file != '.' && $file != '..' && !is_dir($themesHash.$file))
				{
					$themesFile[] = $file;
				}
			}
			closedir($dir);
		} catch (Exception $e) {
		    echo 'Exception reçue : ',  $e->getMessage(), "\n";
		}

		//Lecture de la base de données
		$themesActive = Cachr::getCache('DB_ThemeByType');

		//Identify if is asset admin or public
		$assetType = 'public';
		if (strpos('admin', $urlKey) !== false) {
			$assetType = 'admin';
		}

		//Get theme name
		$themeName = (isset($themesActive[$assetType])?$themesActive[$assetType]:'default');
		$pathForAssets .= $themeName . '/';

		$fcontent = null;
	    try{
			//Lecture du fichier
		    $fcontent = file_get_contents ($themesHash . $themeName . '.json');  
			$json = json_decode ($fcontent);
			$json = (array) $json;
	    } catch (Exception $e) {
		    echo 'Exception reçue : ',  $e->getMessage(), "\n";
		}
	    
    	//retourne la valeur de la clé, si elle existe, passé en params!
    	if(isset($json[$urlKey])){
    		return $pathForAssets . $json[$urlKey];
    	}else{
    		return $pathForAssets . $urlKey;
    		return 'error_assets';
    	}
    }

}