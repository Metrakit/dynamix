<?php
/**
 * Inputizr - Dynamix
 * @version 1.0
 * @author David LEPAUX <d.lepaux@gmail.com>
 * @author Jordane JOUFFROY <contact@jordane.net>
 * @author Tommy CHOISY <contact@tommy-choisy.fr>
 */

class Inputizr extends \Illuminate\Support\Facades\Input {

	public static function alli18n()
	{
		$inputs = Input::except('_token');
		$unsets = array();

		$i18nInputs = array();

		// Ajoute les nouveaux inputs i18n
		foreach ($inputs as $key => $input) {

            if (strpos($key, '_lang_')) {
                $splitInput = explode ("_", $key);
                $i18nInputs[$splitInput[0]][$splitInput[2]] = $input;
                $unsets[$key] = $key;
            }

        }

        // Supprime les anciens inputs
        foreach ($unsets as $value) {
            unset($inputs[$value]);
        }

		return array_merge($inputs, $i18nInputs);
	}

}