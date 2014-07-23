<?php

class LocalesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('locales')->delete();

        DB::table('locales')->insert( array(
            array(
                'id'    => 'af',
                'name'  => 'Africain',
                'enable'=> 0
            ),
            array(
                'id'    => 'sq',
                'name'  => 'Albanais',
                'enable'=> 0
            ),
            array(
                'id'    => 'ar-dz',
                'name'  => 'Algérien',
                'enable'=> 0
            ),
            array(
                'id'    => 'de',
                'name'  => 'Allemand',
                'enable'=> 0
            ),
            array(
                'id'    => 'de-at',
                'name'  => 'Allemand (Austrian)',
                'enable'=> 0
            ),
            array(
                'id'    => 'de-li',
                'name'  => 'Allemand (Liechtenstein)',
                'enable'=> 0
            ),
            array(
                'id'    => 'de-lu',
                'name'  => 'Allemand (Luxembourg)',
                'enable'=> 0
            ),
            array(
                'id'    => 'de-ch',
                'name'  => 'Allemand (Suisse)',
                'enable'=> 0
            ),
            array(
                'id'    => 'en-us',
                'name'  => 'Américain',
                'enable'=> 0
            ),
            array(
                'id'    => 'en',
                'name'  => 'Anglais',
                'enable'=> 1
            ),
            array(
                'id'    => 'en-za',
                'name'  => 'Anglais (Afrique du sud)',
                'enable'=> 0
            ),
            array(
                'id'    => 'en-bz',
                'name'  => 'Anglais (Bélize)',
                'enable'=> 0
            ),
            array(
                'id'    => 'en-gb',
                'name'  => 'Anglais (Grande Bretagne)',
                'enable'=> 0
            ),
            array(
                'id'    => 'ar',
                'name'  => 'Arabe',
                'enable'=> 0
            ),
            array(
                'id'    => 'ar-sa',
                'name'  => 'Arabe (Arabie Saoudite)',
                'enable'=> 0
            ),
            array(
                'id'    => 'ar-bh',
                'name'  => 'Arabe (Bahreïn)',
                'enable'=> 0
            ),
            array(
                'id'    => 'ar-ae',
                'name'  => 'Arabe (Emirat arabe uni)',
                'enable'=> 0
            ),
            array(
                'id'    => 'en-au',
                'name'  => 'Australien',
                'enable'=> 0
            ),
            array(
                'id'    => 'eu',
                'name'  => 'Basque',
                'enable'=> 0
            ),
            array(
                'id'    => 'nl-be',
                'name'  => 'Belge',
                'enable'=> 0
            ),
            array(
                'id'    => 'be',
                'name'  => 'Biélorussie',
                'enable'=> 0
            ),
            array(
                'id'    => 'bg',
                'name'  => 'Bulgarre',
                'enable'=> 0
            ),
            array(
                'id'    => 'en-ca',
                'name'  => 'Canadien',
                'enable'=> 0
            ),
            array(
                'id'    => 'ca',
                'name'  => 'Catalan',
                'enable'=> 0
            ),
            array(
                'id'    => 'zh',
                'name'  => 'Chinois',
                'enable'=> 0
            ),
            array(
                'id'    => 'zh-hk',
                'name'  => 'Chinois (Hong-Kong)',
                'enable'=> 0
            ),
            array(
                'id'    => 'zh-cn',
                'name'  => 'Chinois (PRC)',
                'enable'=> 0
            ),
            array(
                'id'    => 'zh-sg',
                'name'  => 'Chinois (Singapourg)',
                'enable'=> 0
            ),
            array(
                'id'    => 'zh-tw',
                'name'  => 'Chinois (Taïwan)',
                'enable'=> 0
            ),
            array(
                'id'    => 'ko',
                'name'  => 'Coréein',
                'enable'=> 0
            ),
            array(
                'id'    => 'cs',
                'name'  => 'Crète',
                'enable'=> 0
            ),
            array(
                'id'    => 'hr',
                'name'  => 'Croate',
                'enable'=> 0
            ),
            array(
                'id'    => 'da',
                'name'  => 'Danois',
                'enable'=> 0
            ),
            array(
                'id'    => 'ar-eg',
                'name'  => 'Egyptien',
                'enable'=> 0
            ),
            array(
                'id'    => 'es',
                'name'  => 'Espagnol',
                'enable'=> 0
            ),
            array(
                'id'    => 'es-ar',
                'name'  => 'Espagnol (Argentine)',
                'enable'=> 0
            ),
            array(
                'id'    => 'es-bo',
                'name'  => 'Espagnol (Bolivie)',
                'enable'=> 0
            ),
            array(
                'id'    => 'es-cl',
                'name'  => 'Espagnol (Chilie)',
                'enable'=> 0
            ),
            array(
                'id'    => 'es-co',
                'name'  => 'Espagnol (Colombie)',
                'enable'=> 0
            ),
            array(
                'id'    => 'es-cr',
                'name'  => 'Espagnol (Costa Rica)',
                'enable'=> 0
            ),
            array(
                'id'    => 'es-sv',
                'name'  => 'Espagnol (El Salvador)',
                'enable'=> 0
            ),
            array(
                'id'    => 'es-ec',
                'name'  => 'Espagnol (Equateur)',
                'enable'=> 0
            ),
            array(
                'id'    => 'es-gt',
                'name'  => 'Espagnol (Guatemala)',
                'enable'=> 0
            ),
            array(
                'id'    => 'es-hn',
                'name'  => 'Espagnol (Honduras)',
                'enable'=> 0
            ),
            array(
                'id'    => 'es-mx',
                'name'  => 'Espagnol (Mexique)',
                'enable'=> 0
            ),
            array(
                'id'    => 'es-ni',
                'name'  => 'Espagnol (Nicaragua)',
                'enable'=> 0
            ),
            array(
                'id'    => 'es-pa',
                'name'  => 'Espagnol (Panama)',
                'enable'=> 0
            ),
            array(
                'id'    => 'es-py',
                'name'  => 'Espagnol (Paraguay)',
                'enable'=> 0
            ),
            array(
                'id'    => 'es-pe',
                'name'  => 'Espagnol (Pérou)',
                'enable'=> 0
            ),
            array(
                'id'    => 'es-pr',
                'name'  => 'Espagnol (Puerto Rico)',
                'enable'=> 0
            ),
            array(
                'id'    => 'en-tt',
                'name'  => 'Espagnol (Trinidad)',
                'enable'=> 0
            ),
            array(
                'id'    => 'es-uy',
                'name'  => 'Espagnol (Uruguay)',
                'enable'=> 0
            ),
            array(
                'id'    => 'es-ve',
                'name'  => 'Espagnol (Venezuela)',
                'enable'=> 0
            ),
            array(
                'id'    => 'et',
                'name'  => 'Estonien',
                'enable'=> 0
            ),
            array(
                'id'    => 'sx',
                'name'  => 'Estonien',
                'enable'=> 0
            ),
            array(
                'id'    => 'fo',
                'name'  => 'Faeroese',
                'enable'=> 0
            ),
            array(
                'id'    => 'fi',
                'name'  => 'Finlandais',
                'enable'=> 0
            ),
            array(
                'id'    => 'fr',
                'name'  => 'Français',
                'enable'=> 1
            ),
            array(
                'id'    => 'fr-fr',
                'name'  => 'Français',
                'enable'=> 0
            ),
            array(
                'id'    => 'fr-be',
                'name'  => 'Français (Belgique)',
                'enable'=> 0
            ),
            array(
                'id'    => 'fr-ca',
                'name'  => 'Français (Canada)',
                'enable'=> 0
            ),
            array(
                'id'    => 'fr-lu',
                'name'  => 'Français (Luxembourg)',
                'enable'=> 0
            ),
            array(
                'id'    => 'fr-ch',
                'name'  => 'Français (Suisse)',
                'enable'=> 0
            ),
            array(
                'id'    => 'gd',
                'name'  => 'Galicien',
                'enable'=> 0
            ),
            array(
                'id'    => 'el',
                'name'  => 'Gréc',
                'enable'=> 0
            ),
            array(
                'id'    => 'he',
                'name'  => 'Hébreux',
                'enable'=> 0
            ),
            array(
                'id'    => 'nl',
                'name'  => 'Hollandais',
                'enable'=> 0
            ),
            array(
                'id'    => 'hu',
                'name'  => 'Hongrois',
                'enable'=> 0
            ),
            array(
                'id'    => 'in',
                'name'  => 'Indonésien',
                'enable'=> 0
            ),
            array(
                'id'    => 'hi',
                'name'  => 'Indou',
                'enable'=> 0
            ),
            array(
                'id'    => 'fa',
                'name'  => 'Iranien',
                'enable'=> 0
            ),
            array(
                'id'    => 'ar-iq',
                'name'  => 'Iraquien',
                'enable'=> 0
            ),
            array(
                'id'    => 'en-ie',
                'name'  => 'Irlandais',
                'enable'=> 0
            ),
            array(
                'id'    => 'is',
                'name'  => 'Islandais',
                'enable'=> 0
            ),
            array(
                'id'    => 'it',
                'name'  => 'Italien',
                'enable'=> 0
            ),
            array(
                'id'    => 'it-ch',
                'name'  => 'Italien (Suisse)',
                'enable'=> 0
            ),
            array(
                'id'    => 'en-jm',
                'name'  => 'Jamaicain',
                'enable'=> 0
            ),
            array( 
                'id'    => 'ja',
                'name'  => 'Japonais',
                'enable'=> 0
            ),
            array( 
                'id'    => 'ar-jo',
                'name'  => 'Jordanien',
                'enable'=> 0
            ),
            array( 
                'id'    => 'ar-kw',
                'name'  => 'Koweitien',
                'enable'=> 0
            ),
            array( 
                'id'    => 'lv',
                'name'  => 'Lettische',
                'enable'=> 0
            ),
            array( 
                'id'    => 'ar-lb',
                'name'  => 'Libanais',
                'enable'=> 0
            ),
            array( 
                'id'    => 'lt',
                'name'  => 'Littuanien',
                'enable'=> 0
            ),
            array( 
                'id'    => 'ar-ly',
                'name'  => 'Lybien',
                'enable'=> 0
            ),
            array( 
                'id'    => 'mk',
                'name'  => 'Macédoine',
                'enable'=> 0
            ),
            array( 
                'id'    => 'ms',
                'name'  => 'Malésien',
                'enable'=> 0
            ),
            array( 
                'id'    => 'mt',
                'name'  => 'Maltais',
                'enable'=> 0
            ),
            array( 
                'id'    => 'ar-ma',
                'name'  => 'Marocain',
                'enable'=> 0
            ),
            array( 
                'id'    => 'en-nz',
                'name'  => 'Néo-zélandais',
                'enable'=> 0
            ),
            array( 
                'id'    => 'no',
                'name'  => 'Norvégien',
                'enable'=> 0
            ),
            array( 
                'id'    => 'ar-om',
                'name'  => 'Oman',
                'enable'=> 0
            ),
            array( 
                'id'    => 'pl',
                'name'  => 'Polonais',
                'enable'=> 0
            ),
            array( 
                'id'    => 'pt',
                'name'  => 'Portugais',
                'enable'=> 0
            ),
            array( 
                'id'    => 'pt-br',
                'name'  => 'Portugais (Brésil)',
                'enable'=> 0
            ),
            array( 
                'id'    => 'ar-qa',
                'name'  => 'Quatar',
                'enable'=> 0
            ),
            array( 
                'id'    => 'rm',
                'name'  => 'Rhaeto-Romanic',
                'enable'=> 0
            ),
            array( 
                'id'    => 'ro',
                'name'  => 'Roumain (Moldavie)',
                'enable'=> 0
            ),
            array( 
                'id'    => 'ro-mo',
                'name'  => 'Roumain (Moldavie)',
                'enable'=> 0
            ),
            array( 
                'id'    => 'ru',
                'name'  => 'Russe',
                'enable'=> 0
            ),
            array( 
                'id'    => 'ru-mo',
                'name'  => 'Russe (Moldavie)',
                'enable'=> 0
            ),
            array( 
                'id'    => 'sr',
                'name'  => 'Serbe (Latin)',
                'enable'=> 0
            ),
            array( 
                'id'    => 'sk',
                'name'  => 'Slovaque',
                'enable'=> 0
            ),
            array( 
                'id'    => 'sl',
                'name'  => 'Slovéne',
                'enable'=> 0
            ),
            array( 
                'id'    => 'sb',
                'name'  => 'Sorbian',
                'enable'=> 0
            ),
            array( 
                'id'    => 'sv',
                'name'  => 'Suèdois',
                'enable'=> 0
            ),
            array( 
                'id'    => 'sv-fi',
                'name'  => 'Suèdois (Finlande)',
                'enable'=> 0
            ),
            array( 
                'id'    => 'ar-sy',
                'name'  => 'Syrien',
                'enable'=> 0
            ),
            array( 
                'id'    => 'th',
                'name'  => 'Thaïlandais',
                'enable'=> 0
            ),
            array( 
                'id'    => 'ts',
                'name'  => 'Tsonga (Afrique du sud)',
                'enable'=> 0
            ),
            array( 
                'id'    => 'tn',
                'name'  => 'Tswana (Afrique du sud)',
                'enable'=> 0
            ),
            array( 
                'id'    => 'ar-tn',
                'name'  => 'Tunisien',
                'enable'=> 0
            ),
            array( 
                'id'    => 'tr',
                'name'  => 'Turc',
                'enable'=> 0
            ),
            array( 
                'id'    => 'uk',
                'name'  => 'Ukrainien',
                'enable'=> 0
            ),
            array( 
                'id'    => 'ur',
                'name'  => 'Urdu',
                'enable'=> 0
            ),
            array( 
                'id'    => 'vi',
                'name'  => 'Vietnamien',
                'enable'=> 0
            ),
            array(
                'id'    => 'xh',
                'name'  => 'Xhosa (Afrique)',
                'enable'=> 0
            ),
            array( 
                'id'    => 'ar-ye',
                'name'  => 'Yémen',
                'enable'=> 0
            ),
            array( 
                'id'    => 'ji',
                'name'  => 'Yiddish',
                'enable'=> 0
            ),
            array( 
                'id'    => 'zu',
                'name'  => 'Zulu (Afrique)',
                'enable'=> 0
            ))
        );
    }
}
