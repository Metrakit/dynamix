<?php

return array(
	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| such as the size rules. Feel free to tweak each of these messages.
	|
	*/

	"accepted"         => "Le :attribute doit être accepté(e).",
	"active_url"       => "Le :attribute n'est pas une URL valide.",
	"after"            => "Le :attribute doit être une date après :date.",
	"alpha"            => "Le :attribute doit obligatoirement contenir des lettres.",
	"alpha_dash"       => "Le :attribute doit obligatoirement contenir des lettres, chiffres et tirets.",
	"alpha_num"        => "Le :attribute doit obligatoirement contenir des lettres et chiffres.",
	"before"           => "Le :attribute doit être une date avant :date.",
	"between"          => array(
		"numeric" => "Le :attribute doit être entre :min - :max.",
		"file"    => "Le :attribute doit être entre :min - :max kilobytes.",
		"string"  => "Le :attribute doit être entre :min - :max caractères.",
	),
	"confirmed"        => "Le :attribute confirmation ne correspond pas.",
	"date"             => "Le :attribute n'est pas une date valide.",
	"date_format"      => "Le :attribute ne trouve pas le format :format.",
	"different"        => "Le :attribute et :other doit être différent.",
	"digits"           => "Le :attribute doit être :digits digits.",
	"digits_between"   => "Le :attribute doit être entre :min et :max digits.",
	"email"            => "Le :attribute format est invalide.",
	"exists"           => "Le :attribute selectionné(e) est valide.",
	"image"            => "Le :attribute doit être une image.",
	"in"               => "Le :attribute selectionné(e) est valide.",
	"integer"          => "Le :attribute doit être un entier.",
	"ip"               => "Le :attribute doit être une adresse IP valide.",
	"max"              => array(
		"numeric" => "Le :attribute ne doit pas être suppérieur à :max.",
		"file"    => "Le :attribute ne doit pas être suppérieur à :max kilobytes.",
		"string"  => "Le :attribute ne doit pas être suppérieur à :max caractères.",
	),
	"mimes"            => "Le :attribute must be a file of type: :values.",
	"min"              => array(
		"numeric" => "Le :attribute doit être inférieur à :min.",
		"file"    => "Le :attribute doit être inférieur à :min kilobytes.",
		"string"  => "Le :attribute doit être inférieur à :min caractères.",
	),
	"not_in"           => "Le :attribute selectionné(e) est valide.",
	"numeric"          => "Le :attribute doit être un chiffre.",
	"regex"            => "Le :attribute format est valide.",
	"required"         => "Le :attribute champs est requis.",
	"required_if"      => "Le :attribute champs est requis quand :other est :value.",
	"required_with"    => "Le :attribute champs est requis quand :values est présent.",
	"required_without" => "Le :attribute champs est requis quand :values n'est pas présent.",
	"same"             => "Le :attribute et :other must match.",
	"size"             => array(
		"numeric" => "Le :attribute doit être :size.",
		"file"    => "Le :attribute doit être :size kilobytes.",
		"string"  => "Le :attribute doit être :size caractères.",
	),
	"unique"           => "Le :attribute a déjà été pris.",
	"url"              => "Le :attribute format est valide.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(),

);
