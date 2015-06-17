<?php

class LocalesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('locales')->delete();

        DB::table('locales')->insert( array(
            array(
                'id'            => 'de',
                'name_en'       => 'German',
                'name_locale'   => 'Deutsch',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/5/52/D-A-CH_Flag.svg/200px-D-A-CH_Flag.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'ca',
                'name_en'       => 'Catalan',
                'name_locale'   => 'Català',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/c/ce/Flag_of_Catalonia.svg/200px-Flag_of_Catalonia.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'fr',
                'name_en'       => 'French',
                'name_locale'   => 'Français',
                'flag'          => '//upload.wikimedia.org/wikipedia/en/thumb/c/c3/Flag_of_France.svg/200px-Flag_of_France.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => true,
                'enable'        => 1,
                'on_admin'      => 1
            ),

            array(
                'id'            => 'en',
                'name_en'       => 'English',
                'name_locale'   => 'English',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/0/0b/English_language.svg/200px-English_language.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '105',
                'is_publish'    => true,
                'enable'        => 1,
                'on_admin'      => 1
            ),

            array(
                'id'            => 'sv',
                'name_en'       => 'Swedish',
                'name_locale'   => 'Svenska',
                'flag'          => '//upload.wikimedia.org/wikipedia/en/thumb/4/4c/Flag_of_Sweden.svg/200px-Flag_of_Sweden.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '125',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'it',
                'name_en'       => 'Italian',
                'name_locale'   => 'Italiano',
                'flag'          => '//upload.wikimedia.org/wikipedia/en/thumb/0/03/Flag_of_Italy.svg/200px-Flag_of_Italy.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'es',
                'name_en'       => 'Spanish',
                'name_locale'   => 'Español',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/3/32/Flag_of_Spain_%28Civil%29.svg/200px-Flag_of_Spain_%28Civil%29.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 1
            ),

            array(
                'id'            => 'pt',
                'name_en'       => 'Portuguese',
                'name_locale'   => 'Português',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/c/cf/Flags_of_Brazil_and_Portugal.svg/200px-Flags_of_Brazil_and_Portugal.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '140',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 1
            ),

            array(
                'id'            => 'ru',
                'name_en'       => 'Russian',
                'name_locale'   => 'Русский',
                'flag'          => '//upload.wikimedia.org/wikipedia/en/thumb/f/f3/Flag_of_Russia.svg/200px-Flag_of_Russia.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'nl',
                'name_en'       => 'Dutch',
                'name_locale'   => 'Nederlands',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/9/95/Flag_of_Dutch_language.svg/200px-Flag_of_Dutch_language.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'pl',
                'name_en'       => 'Polish',
                'name_locale'   => 'Polski',
                'flag'          => '//upload.wikimedia.org/wikipedia/en/thumb/1/12/Flag_of_Poland.svg/200px-Flag_of_Poland.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '125',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),
/*
            array(
                'id'            => 'eo',
                'name_en'       => 'Esperanto',
                'name_locale'   => 'Esperanto',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/f/f5/Flag_of_Esperanto.svg/200px-Flag_of_Esperanto.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'af',
                'name_en'       => 'Afrikaans',
                'name_locale'   => 'Afrikaans',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/0/00/Afrikaner_Vryheidsvlag.svg/200px-Afrikaner_Vryheidsvlag.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '120',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/
/*
            array(
                'id'            => 'no',
                'name_en'       => 'Norwegian (Bokmål)',
                'name_locale'   => 'Norsk (Bokmål)',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/d/d9/Flag_of_Norway.svg/200px-Flag_of_Norway.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '145',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

            /*array(
                'id'            => 'eu',
                'name_en'       => 'Basque',
                'name_locale'   => 'Euskara',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/1/19/Flag_of_the_Basque_Country_alternative_proportions.svg/200px-Flag_of_the_Basque_Country_alternative_proportions.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'az',
                'name_en'       => 'Azerbaijani',
                'name_locale'   => 'Azərbaycanca',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/d/dd/Flag_of_Azerbaijan.svg/200px-Flag_of_Azerbaijan.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '100',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

            array(
                'id'            => 'da',
                'name_en'       => 'Danish',
                'name_locale'   => 'Dansk',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/9/9c/Flag_of_Denmark.svg/200px-Flag_of_Denmark.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '151',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'fi',
                'name_en'       => 'Finnish',
                'name_locale'   => 'Suomi',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/b/bc/Flag_of_Finland.svg/200px-Flag_of_Finland.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '122',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'sl',
                'name_en'       => 'Slovenian',
                'name_locale'   => 'Slovenščina',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/d/d1/Civil_Ensign_of_Slovenia.svg/200px-Civil_Ensign_of_Slovenia.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'cs',
                'name_en'       => 'Czech',
                'name_locale'   => 'Čeština',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/c/cb/Flag_of_the_Czech_Republic.svg/200px-Flag_of_the_Czech_Republic.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

/*            array(
                'id'            => 'la',
                'name_en'       => 'Latin',
                'name_locale'   => 'Latina',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/8/83/Vexilloid_of_the_Roman_Empire.svg/120px-Vexilloid_of_the_Roman_Empire.svg.png',
                'flag_w'        => '120',
                'flag_h'        => '168',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

/*            array(
                'id'            => 'as',
                'name_en'       => 'Assamese',
                'name_locale'   => 'অসমীয়া',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/9/94/Flag_of_Assam.svg/200px-Flag_of_Assam.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'ba',
                'name_en'       => 'Bashkir',
                'name_locale'   => 'Башҡорт',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/3/3d/Flag_of_Bashkortostan.svg/200px-Flag_of_Bashkortostan.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'ha',
                'name_en'       => 'Hausa',
                'name_locale'   => 'هَوُسَ',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/5/5d/Flag_of_the_Hausa_people.svg/200px-Flag_of_the_Hausa_people.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'kk',
                'name_en'       => 'Kazakh',
                'name_locale'   => 'Қазақша',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/d/d3/Flag_of_Kazakhstan.svg/200px-Flag_of_Kazakhstan.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '100',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

            array(
                'id'            => 'km',
                'name_en'       => 'Khmer',
                'name_locale'   => 'ភាសាខ្មែរ',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/8/83/Flag_of_Cambodia.svg/200px-Flag_of_Cambodia.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '128',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),
/*
            array(
                'id'            => 'rw',
                'name_en'       => 'Kinyarwanda',
                'name_locale'   => 'Ikinyarwanda',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/1/17/Flag_of_Rwanda.svg/200px-Flag_of_Rwanda.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'ky',
                'name_en'       => 'Kirghiz',
                'name_locale'   => 'Кыргызча',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/c/c7/Flag_of_Kyrgyzstan.svg/200px-Flag_of_Kyrgyzstan.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '120',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'ne',
                'name_en'       => 'Nepali',
                'name_locale'   => 'नेपाली',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/9/9b/Flag_of_Nepal.svg/120px-Flag_of_Nepal.svg.png',
                'flag_w'        => '120',
                'flag_h'        => '146',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'pa',
                'name_en'       => 'Punjabi',
                'name_locale'   => 'ਪੰਜਾਬੀ',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/d/d5/Nishan_Sahib.svg/200px-Nishan_Sahib.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '122',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/
/*
            array(
                'id'            => 'et',
                'name_en'       => 'Estonian',
                'name_locale'   => 'Eesti',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/8/8f/Flag_of_Estonia.svg/200px-Flag_of_Estonia.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '127',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

            array(
                'id'            => 'ja',
                'name_en'       => 'Japanese',
                'name_locale'   => '日本語',
                'flag'          => '//upload.wikimedia.org/wikipedia/en/thumb/9/9e/Flag_of_Japan.svg/200px-Flag_of_Japan.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'ko',
                'name_en'       => 'Korean',
                'name_locale'   => '한국어',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/0/09/Flag_of_South_Korea.svg/200px-Flag_of_South_Korea.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),
/*
            array(
                'id'            => 'yo',
                'name_en'       => 'Yoruba',
                'name_locale'   => 'Yorùbá',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/0/04/Flag_of_the_Yoruba_people.svg/200px-Flag_of_the_Yoruba_people.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/


            array(
                'id'            => 'zh',
                'name_en'       => 'Chinese',
                'name_locale'   => '中文',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/9/9d/Han_Chinese_flag.svg/120px-Han_Chinese_flag.svg.png',
                'flag_w'        => '120',
                'flag_h'        => '130',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),
            /*
            array(
                'id'            => 'my',
                'name_en'       => 'Burmese',
                'name_locale'   => 'မ္ရန္‌မာစာ',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/8/8c/Flag_of_Myanmar.svg/200px-Flag_of_Myanmar.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'ms',
                'name_en'       => 'Malay',
                'name_locale'   => 'Bahasa Melayu',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/6/66/Flag_of_Malaysia.svg/200px-Flag_of_Malaysia.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '100',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),
*/
            array(
                'id'            => 'vi',
                'name_en'       => 'Vietnamese',
                'name_locale'   => 'Tiếng Việt',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/2/21/Flag_of_Vietnam.svg/200px-Flag_of_Vietnam.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),
            array(
                'id'            => 'el',
                'name_en'       => 'Greek',
                'name_locale'   => 'Ελληνικά',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/6/6e/Flag_of_Greece_%281822-1978%29.svg/200px-Flag_of_Greece_%281822-1978%29.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

/*            array(
                'id'            => 'om',
                'name_en'       => 'Oromo',
                'name_locale'   => 'Oromoo',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/3/3c/Flag_of_the_Oromia_Region.svg/200px-Flag_of_the_Oromia_Region.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '100',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

            array(
                'id'            => 'tr',
                'name_en'       => 'Turkish',
                'name_locale'   => 'Türkçe',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/b/b4/Flag_of_Turkey.svg/200px-Flag_of_Turkey.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'bs',
                'name_en'       => 'Bosnian',
                'name_locale'   => 'Bosanski',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/9/9d/Bosniak_national_flag.svg/200px-Bosniak_national_flag.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '100',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

/*            array(
                'id'            => 'am',
                'name_en'       => 'Amharic',
                'name_locale'   => 'አማርኛ',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/f/f1/Flag_of_the_Amhara_Region.svg/200px-Flag_of_the_Amhara_Region.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '100',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),
            array(
                'id'            => 'ml',
                'name_en'       => 'Malayalam',
                'name_locale'   => 'മലയാളം',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/7/74/Malayali_flag.svg/200px-Malayali_flag.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

/*            array(
                'id'            => 'sh',
                'name_en'       => 'Serbo-Croatian',
                'name_locale'   => 'Srpskohrvatski / Српскохрватски',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/e/e7/Flag_of_the_Kingdom_of_Yugoslavia.svg/200px-Flag_of_the_Kingdom_of_Yugoslavia.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),
*/
            array(
                'id'            => 'lt',
                'name_en'       => 'Lithuanian',
                'name_locale'   => 'Lietuvių',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/1/11/Flag_of_Lithuania.svg/200px-Flag_of_Lithuania.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '120',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

/*            array(
                'id'            => 'jv',
                'name_en'       => 'Javanese',
                'name_locale'   => 'Basa Jawa',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/d/da/Flag_of_the_Sultanate_of_Mataram.svg/200px-Flag_of_the_Sultanate_of_Mataram.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '101',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

            array(
                'id'            => 'hr',
                'name_en'       => 'Croatian',
                'name_locale'   => 'Hrvatski',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/0/0f/Flag_of_Croatia_%28white_chequy%29.svg/200px-Flag_of_Croatia_%28white_chequy%29.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'sr',
                'name_en'       => 'Serbian',
                'name_locale'   => 'Српски / Srpski',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/1/11/Civil_Flag_of_Serbia.svg/200px-Civil_Flag_of_Serbia.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

/*            array(
                'id'            => 'bh',
                'name_en'       => 'Bihari',
                'name_locale'   => 'भोजपुरी',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/e/e9/Seal_of_Bihar.svg/101px-Seal_of_Bihar.svg.png',
                'flag_w'        => '101',
                'flag_h'        => '121',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'gl',
                'name_en'       => 'Galician',
                'name_locale'   => 'Galego',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/c/c0/Bandeira_galega_civil.svg/200px-Bandeira_galega_civil.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

            array(
                'id'            => 'cy',
                'name_en'       => 'Welsh',
                'name_locale'   => 'Cymraeg',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/5/59/Flag_of_Wales_2.svg/200px-Flag_of_Wales_2.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '120',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'th',
                'name_en'       => 'Thai',
                'name_locale'   => 'ไทย',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Flag_of_Thailand.svg/200px-Flag_of_Thailand.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),
/*
            array(
                'id'            => 'sw',
                'name_en'       => 'Swahili',
                'name_locale'   => 'Kiswahili',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Flag_of_EAC.svg/200px-Flag_of_EAC.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '110',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'zh-min-nan',
                'name_en'       => 'Min Nan',
                'name_locale'   => 'Bân-lâm-gú',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/1/10/Flag_of_Taiwan_proposed_1996.svg/200px-Flag_of_Taiwan_proposed_1996.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'mr',
                'name_en'       => 'Marathi',
                'name_locale'   => 'मराठी',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Maharashtradhvaj.png/200px-Maharashtradhvaj.png',
                'flag_w'        => '200',
                'flag_h'        => '94',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

            array(
                'id'            => 'id',
                'name_en'       => 'Indonesian',
                'name_locale'   => 'Bahasa Indonesia',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/9/9f/Flag_of_Indonesia.svg/200px-Flag_of_Indonesia.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),
/*
            array(
                'id'            => 'ka',
                'name_en'       => 'Georgian',
                'name_locale'   => 'ქართული',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/0/0f/Flag_of_Georgia.svg/200px-Flag_of_Georgia.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

           /* array(
                'id'            => 'lv',
                'name_en'       => 'Latvian',
                'name_locale'   => 'Latviešu',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/8/84/Flag_of_Latvia.svg/200px-Flag_of_Latvia.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '100',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'ga',
                'name_en'       => 'Irish',
                'name_locale'   => 'Gaeilge',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/4/45/Flag_of_Ireland.svg/200px-Flag_of_Ireland.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '100',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

            array(
                'id'            => 'ro',
                'name_en'       => 'Romanian',
                'name_locale'   => 'Română',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/7/73/Flag_of_Romania.svg/200px-Flag_of_Romania.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

/*            array(
                'id'            => 'kn',
                'name_en'       => 'Kannada',
                'name_locale'   => 'ಕನ್ನಡ',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/c/ce/Flag_of_Karnataka.svg/200px-Flag_of_Karnataka.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'gn',
                'name_en'       => 'Guarani',
                'name_locale'   => 'Avañe\'ẽ',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/9/99/Guarani_flag.svg/200px-Guarani_flag.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '110',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'wo',
                'name_en'       => 'Wolof',
                'name_locale'   => 'Wolof',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/f/fd/Flag_of_Senegal.svg/200px-Flag_of_Senegal.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

            array(
                'id'            => 'hu',
                'name_en'       => 'Hungarian',
                'name_locale'   => 'Magyar',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/b/bc/Civil_Ensign_of_Hungary.svg/200px-Civil_Ensign_of_Hungary.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),
            array(
                'id'            => 'he',
                'name_en'       => 'Hebrew',
                'name_locale'   => 'עברית',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/d/d4/Flag_of_Israel.svg/200px-Flag_of_Israel.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '145',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),
/*
            array(
                'id'            => 'ar',
                'name_en'       => 'Arabic',
                'name_locale'   => 'العربية',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/b/bb/Arabic-Language-Flag.svg/200px-Arabic-Language-Flag.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

            array(
                'id'            => 'hi',
                'name_en'       => 'Hindi',
                'name_locale'   => 'हिन्दी',
                'flag'          => '//upload.wikimedia.org/wikipedia/en/thumb/4/41/Flag_of_India.svg/200px-Flag_of_India.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            /*
            array(
                'id'            => 'lo',
                'name_en'       => 'Lao',
                'name_locale'   => 'ລາວ',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/5/56/Flag_of_Laos.svg/200px-Flag_of_Laos.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'bi',
                'name_en'       => 'Bislama',
                'name_locale'   => 'Bislama',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/b/bc/Flag_of_Vanuatu.svg/200px-Flag_of_Vanuatu.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '120',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'wa',
                'name_en'       => 'Walloon',
                'name_locale'   => 'Walon',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/4/42/Flag_of_Wallonia.svg/200px-Flag_of_Wallonia.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'nah',
                'name_en'       => 'Nahuatl',
                'name_locale'   => 'Nāhuatl',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/f/fc/Flag_of_Mexico.svg/200px-Flag_of_Mexico.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '114',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

            array(
                'id'            => 'mk',
                'name_en'       => 'Macedonian',
                'name_locale'   => 'Македонски',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/5/59/Flag_of_Macedonia_-_ethnic.svg/200px-Flag_of_Macedonia_-_ethnic.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '100',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),
/*
            array(
                'id'            => 'st',
                'name_en'       => 'Sesotho',
                'name_locale'   => 'Sesotho',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/4/4a/Flag_of_Lesotho.svg/200px-Flag_of_Lesotho.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'gv',
                'name_en'       => 'Manx',
                'name_locale'   => 'Gaelg',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/5/5d/Flag_of_the_Isle_of_Mann.svg/200px-Flag_of_the_Isle_of_Mann.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '100',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),
*/
            array(
                'id'            => 'sk',
                'name_en'       => 'Slovak',
                'name_locale'   => 'Slovenči',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/e/e6/Flag_of_Slovakia.svg/200px-Flag_of_Slovakia.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),
/*
            array(
                'id'            => 'mo',
                'name_en'       => 'Moldovan',
                'name_locale'   => 'Молдовеняскэ',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/2/27/Flag_of_Moldova.svg/200px-Flag_of_Moldova.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '100',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),
*/
            array(
                'id'            => 'sq',
                'name_en'       => 'Albanian',
                'name_locale'   => 'Shqip',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/3/36/Flag_of_Albania.svg/200px-Flag_of_Albania.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '143',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

/*            array(
                'id'            => 'ab',
                'name_en'       => 'Abkhazian',
                'name_locale'   => 'Аҧсуа',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/2/27/Flag_of_Abkhazia.svg/200px-Flag_of_Abkhazia.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '100',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'oc',
                'name_en'       => 'Occitan',
                'name_locale'   => 'Occitan',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/4/45/Flag_of_Occitania.svg/200px-Flag_of_Occitania.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'su',
                'name_en'       => 'Sundanese',
                'name_locale'   => 'Basa Sunda',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/8/82/Flag_of_West_Java.svg/200px-Flag_of_West_Java.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'qu',
                'name_en'       => 'Quechua',
                'name_locale'   => 'Runa Simi',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/3/3b/Flag_of_Cusco.svg/200px-Flag_of_Cusco.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '114',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'tw',
                'name_en'       => 'Twi',
                'name_locale'   => 'Twi',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/e/ed/Flag_of_Ashanti.svg/120px-Flag_of_Ashanti.svg.png',
                'flag_w'        => '120',
                'flag_h'        => '80',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'als',
                'name_en'       => 'Alemannic',
                'name_locale'   => 'Alemannisch',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/b/be/Proposed_Alemannic_flag.svg/200px-Proposed_Alemannic_flag.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '127',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'mi',
                'name_en'       => 'Maori',
                'name_locale'   => 'Māori',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/3/30/Tino_Rangatiratanga_Maori_sovereignty_movement_flag.svg/200px-Tino_Rangatiratanga_Maori_sovereignty_movement_flag.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '111',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'ay',
                'name_en'       => 'Aymara',
                'name_locale'   => 'Aymar',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/b/b7/Banner_of_the_Qulla_Suyu.svg/120px-Banner_of_the_Qulla_Suyu.svg.png',
                'flag_w'        => '120',
                'flag_h'        => '120',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

            array(
                'id'            => 'fa',
                'name_en'       => 'Persian',
                'name_locale'   => 'فارسی',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/9/97/Ethnic_Persian_flag.svg/200px-Ethnic_Persian_flag.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '114',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),/*

            array(
                'id'            => 'ceb',
                'name_en'       => 'Cebuano',
                'name_locale'   => 'Sinugboanong Binisaya',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/0/03/Flag_of_Bohol_Province%2C_Philippines.svg/200px-Flag_of_Bohol_Province%2C_Philippines.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '100',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'tl',
                'name_en'       => 'Tagalog',
                'name_locale'   => 'Tagalog',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/0/0a/Flag_of_the_Tagalog_people.svg/200px-Flag_of_the_Tagalog_people.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '115',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

            array(
                'id'            => 'is',
                'name_en'       => 'Icelandic',
                'name_locale'   => 'Íslenska',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/c/ce/Flag_of_Iceland.svg/200px-Flag_of_Iceland.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '144',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'bg',
                'name_en'       => 'Bulgarian',
                'name_locale'   => 'Български',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Flag_of_Bulgaria.svg/200px-Flag_of_Bulgaria.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '120',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

/*            array(
                'id'            => 'te',
                'name_en'       => 'Telugu',
                'name_locale'   => 'తెలుగు',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/7/70/Flag_of_Telangana.svg/200px-Flag_of_Telangana.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),


            array(
                'id'            => 'ug',
                'name_en'       => 'Uyghur',
                'name_locale'   => 'Oyghurque',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Kokbayraq_flag.svg/200px-Kokbayraq_flag.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'sa',
                'name_en'       => 'Sanskrit',
                'name_locale'   => 'संस्कृतम्',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/8/8e/Om.svg/120px-Om.svg.png',
                'flag_w'        => '120',
                'flag_h'        => '124',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'uz',
                'name_en'       => 'Uzbek',
                'name_locale'   => 'O‘zbek',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/8/84/Flag_of_Uzbekistan.svg/200px-Flag_of_Uzbekistan.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '100',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'bo',
                'name_en'       => 'Tibetan',
                'name_locale'   => 'བོད་སྐད',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/3/3c/Flag_of_Tibet.svg/200px-Flag_of_Tibet.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '125',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

            /*array(
                'id'            => 'rm',
                'name_en'       => 'Romansh',
                'name_locale'   => 'Rumantsch',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/9/98/Proposed_Flag_of_Romanchia.svg/120px-Proposed_Flag_of_Romanchia.svg.png',
                'flag_w'        => '120',
                'flag_h'        => '120',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

            /*array(
                'id'            => 'sd',
                'name_en'       => 'Sindhi',
                'name_locale'   => 'سنڌي، سندھی ، सिन्ध',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/0/00/Flag_of_Sindhudesh.svg/200px-Flag_of_Sindhudesh.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'io',
                'name_en'       => 'Ido',
                'name_locale'   => 'Ido',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/f/f1/Flag_of_Ido.svg/200px-Flag_of_Ido.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '108',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'ur',
                'name_en'       => 'Urdu',
                'name_locale'   => 'اردو',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/3/32/Flag_of_Pakistan.svg/200px-Flag_of_Pakistan.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),
            array(
                'id'            => 'ku',
                'name_en'       => 'Kurdish',
                'name_locale'   => 'Kurdî / كوردی',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/3/35/Flag_of_Kurdistan.svg/200px-Flag_of_Kurdistan.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'vo',
                'name_en'       => 'Volapük',
                'name_locale'   => 'Volapük',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/e/e3/Volapuk_symbol.svg/120px-Volapuk_symbol.svg.png',
                'flag_w'        => '120',
                'flag_h'        => '120',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'tg',
                'name_en'       => 'Tajik',
                'name_locale'   => 'Тоҷикӣ',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/d/d0/Flag_of_Tajikistan.svg/200px-Flag_of_Tajikistan.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '100',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

/*            array(
                'id'            => 'uk',
                'name_en'       => 'Ukrainian',
                'name_locale'   => 'Українська',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/4/49/Flag_of_Ukraine.svg/200px-Flag_of_Ukraine.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

            /*array(
                'id'            => 'yi',
                'name_en'       => 'Yiddish',
                'name_locale'   => 'ייִדיש',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/d/d6/Proposed_Yiddish_flag.svg/200px-Proposed_Yiddish_flag.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '145',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'roa-rup',
                'name_en'       => 'Aromanian',
                'name_locale'   => 'Armãneashce',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/9/97/Aromanian_flag.svg/200px-Aromanian_flag.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '100',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'chr',
                'name_en'       => 'Cherokee',
                'name_locale'   => 'ᏣᎳᎩ',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/4/4d/Flag_of_the_Cherokee_Nation.svg/200px-Flag_of_the_Cherokee_Nation.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '120',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'se',
                'name_en'       => 'Northern Sami',
                'name_locale'   => 'Sámegiella',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Sami_flag.svg/200px-Sami_flag.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '149',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'an',
                'name_en'       => 'Aragonese',
                'name_locale'   => 'Aragonés',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/b/bc/EstreladaAragonesa.svg/200px-EstreladaAragonesa.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/
/*
            array(
                'id'            => 'lb',
                'name_en'       => 'Luxembourgish',
                'name_locale'   => 'Lëtzebuergesch',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/3/38/Civil_Ensign_of_Luxembourg.svg/200px-Civil_Ensign_of_Luxembourg.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '143',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'mt',
                'name_en'       => 'Maltese',
                'name_locale'   => 'Malti',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/6/6a/Civil_Ensign_of_Malta.svg/200px-Civil_Ensign_of_Malta.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),
*/
            /*array(
                'id'            => 'ee',
                'name_en'       => 'Ewe',
                'name_locale'   => 'Eʋegbe',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/b/b8/Flag_of_the_Ewe_people.svg/200px-Flag_of_the_Ewe_people.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'arc',
                'name_en'       => 'Assyrian Neo-Aramaic',
                'name_locale'   => 'ܐܪܡܝܐ',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/c/cd/Flag_of_the_Assyrian_people.svg/200px-Flag_of_the_Assyrian_people.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'za',
                'name_en'       => 'Zhuang',
                'name_locale'   => 'Cuengh',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/0/0f/Sawndip.svg/200px-Sawndip.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '100',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),
            array(
                'id'            => 'ch',
                'name_en'       => 'Chamorro',
                'name_locale'   => 'Chamoru',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Flag_of_the_Northern_Mariana_Islands.svg/200px-Flag_of_the_Northern_Mariana_Islands.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '100',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

          /*  array(
                'id'            => 'nn',
                'name_en'       => 'Norwegian (Nynorsk)',
                'name_locale'   => 'Nynorsk',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/d/da/Flag_of_Vestlandet.svg/200px-Flag_of_Vestlandet.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '144',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

            /*array(
                'id'            => 'ast',
                'name_en'       => 'Asturian',
                'name_locale'   => 'Asturianu',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/3/3e/Flag_of_Asturias.svg/200px-Flag_of_Asturias.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'ak',
                'name_en'       => 'Akan',
                'name_locale'   => 'Akana',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/e/ed/Flag_of_Ashanti.svg/200px-Flag_of_Ashanti.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'jbo',
                'name_en'       => 'Lojban',
                'name_locale'   => 'Lojban',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/4/48/Lojban_logo.svg/200px-Lojban_logo.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/
/*
            array(
                'id'            => 'be',
                'name_en'       => 'Belarusian',
                'name_locale'   => 'Беларуская',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/8/85/Flag_of_Belarus.svg/200px-Flag_of_Belarus.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '100',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),
*/
            /*array(
                'id'            => 'mus',
                'name_en'       => 'Muscogee',
                'name_locale'   => 'Muskogee',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/0/08/Flag_of_the_Creek_Nation.svg/200px-Flag_of_the_Creek_Nation.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),
            array(
                'id'            => 'nv',
                'name_en'       => 'Navajo',
                'name_locale'   => 'Diné bizaad',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/0/0c/Navajo_flag.svg/200px-Navajo_flag.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '120',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'dv',
                'name_en'       => 'Divehi',
                'name_locale'   => 'ދިވެހިބަސް',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/0/0f/Flag_of_Maldives.svg/200px-Flag_of_Maldives.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 've',
                'name_en'       => 'Venda',
                'name_locale'   => 'Tshivenda',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/3/3a/Flag_of_Venda.svg/200px-Flag_of_Venda.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'kg',
                'name_en'       => 'Kongo',
                'name_locale'   => 'KiKongo',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/f/f1/Flag_of_Musikongo.svg/200px-Flag_of_Musikongo.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '130',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),
            array(
                'id'            => 'ig',
                'name_en'       => 'Igbo',
                'name_locale'   => 'Igbo',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/8/82/Flag_of_Biafra.svg/200px-Flag_of_Biafra.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '114',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'ff',
                'name_en'       => 'Fula',
                'name_locale'   => 'Fulfulde',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/e/ed/Flag_of_Guinea.svg/200px-Flag_of_Guinea.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'cr',
                'name_en'       => 'Cree',
                'name_locale'   => 'Nehiyaw',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/4/4f/Flag_of_Ouj%C3%A9-Bougoumou.svg/200px-Flag_of_Ouj%C3%A9-Bougoumou.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '128',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),
            array(
                'id'            => 'bm',
                'name_en'       => 'Bambara',
                'name_locale'   => 'Bamanankan',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/9/92/Flag_of_Mali.svg/200px-Flag_of_Mali.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'av',
                'name_en'       => 'Avar',
                'name_locale'   => 'Авар',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/7/77/Khunz_Wolf_3b.svg/200px-Khunz_Wolf_3b.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '99',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'ty',
                'name_en'       => 'Tahitian',
                'name_locale'   => 'Reo Mā`ohi',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/4/48/Flag_of_Tahiti.svg/200px-Flag_of_Tahiti.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'pi',
                'name_en'       => 'Pali',
                'name_locale'   => 'पाऴि',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/7/77/Flag_of_Buddhism.svg/200px-Flag_of_Buddhism.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'ny',
                'name_en'       => 'Chichewa',
                'name_locale'   => 'Chi-Chewa',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/d/d1/Flag_of_Malawi.svg/200px-Flag_of_Malawi.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'mh',
                'name_en'       => 'Marshallese',
                'name_locale'   => 'Ebon',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/2/2e/Flag_of_the_Marshall_Islands.svg/200px-Flag_of_the_Marshall_Islands.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '105',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'kv',
                'name_en'       => 'Komi',
                'name_locale'   => 'Коми',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/5/54/Flag_of_Komi.svg/200px-Flag_of_Komi.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'kj',
                'name_en'       => 'Kuanyama',
                'name_locale'   => 'Kuanyama',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/e/ee/Ovamboland_flag.svg/120px-Ovamboland_flag.svg.png',
                'flag_w'        => '120',
                'flag_h'        => '80',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'cv',
                'name_en'       => 'Chuvash',
                'name_locale'   => 'Чăваш',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/d/d7/Flag_of_Chuvashia.svg/200px-Flag_of_Chuvashia.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '125',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'li',
                'name_en'       => 'Limburgian',
                'name_locale'   => 'Limburgs',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/5/53/NL-LimburgVlag.svg/200px-NL-LimburgVlag.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'ii',
                'name_en'       => 'Sichuan Yi',
                'name_locale'   => 'ꆇꉙ',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/9/9d/Proposed_Yi_flag.svg/200px-Proposed_Yi_flag.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '120',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'ht',
                'name_en'       => 'Haitian',
                'name_locale'   => 'Krèyol ayisyen',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/e/e5/Flag_of_Haiti_%28civil%29.svg/200px-Flag_of_Haiti_%28civil%29.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '120',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'cho',
                'name_en'       => 'Choctaw',
                'name_locale'   => 'Choctaw',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Choctaw_seal.svg/120px-Choctaw_seal.svg.png',
                'flag_w'        => '120',
                'flag_h'        => '120',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'haw',
                'name_en'       => 'Hawaiian',
                'name_locale'   => 'Hawai`i',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/a/ae/Kanaka_Maoli_flag.svg/200px-Kanaka_Maoli_flag.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '111',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'scn',
                'name_en'       => 'Sicilian',
                'name_locale'   => 'Sicilianu',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/7/7a/Flag_of_Sicily.svg/200px-Flag_of_Sicily.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'ang',
                'name_en'       => 'Anglo-Saxon',
                'name_locale'   => 'Englisc',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/3/3c/White_Dragon_Flag_of_England.svg/200px-White_Dragon_Flag_of_England.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '120',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

            /*array(
                'id'            => 'fur',
                'name_en'       => 'Friulian',
                'name_locale'   => 'Furlan',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/8/87/Bandiere_dal_Fri%C3%BBl.svg/200px-Bandiere_dal_Fri%C3%BBl.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '134',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'hy',
                'name_en'       => 'Armenian',
                'name_locale'   => 'Հայերեն',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Flag_of_Armenia.svg/200px-Flag_of_Armenia.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '100',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'diq',
                'name_en'       => 'Zazaki',
                'name_locale'   => 'Zazaki',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/6/66/Flag_Of_Zazaistan.svg/200px-Flag_Of_Zazaistan.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),
            array(
                'id'            => 'fiu-vro',
                'name_en'       => 'Võro',
                'name_locale'   => 'Võro',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/e/e5/Flag_of_V%C3%B5ro.svg/200px-Flag_of_V%C3%B5ro.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '128',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'pam',
                'name_en'       => 'Kapampangan',
                'name_locale'   => 'Kapampangan',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/b/b4/Proposed_Kapampangan_flag.svg/200px-Proposed_Kapampangan_flag.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '132',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'sco',
                'name_en'       => 'Scots',
                'name_locale'   => 'Scots',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/4/48/Lionrampant.svg/200px-Lionrampant.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '119',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'lmo',
                'name_en'       => 'Lombard',
                'name_locale'   => 'Lumbaart',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/e/ea/Flag_of_Lombardy.svg/200px-Flag_of_Lombardy.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'nap',
                'name_en'       => 'Neapolitan',
                'name_locale'   => 'Nnapulitano',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/c/ca/Flag_of_Naples.svg/200px-Flag_of_Naples.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'war',
                'name_en'       => 'Waray-Waray',
                'name_locale'   => 'Winaray',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/6/6b/Isla.svg/120px-Isla.svg.png',
                'flag_w'        => '120',
                'flag_h'        => '120',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'lad',
                'name_en'       => 'Ladino',
                'name_locale'   => 'Dzhudezmo',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/7/7f/Jewish_Merchant_Flag_1453-1793.svg/200px-Jewish_Merchant_Flag_1453-1793.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),
            array(
                'id'            => 'ilo',
                'name_en'       => 'Ilokano',
                'name_locale'   => 'Ilokano',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/6/6c/Ilocos_Sur.svg/200px-Ilocos_Sur.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '134',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'bug',
                'name_en'       => 'Buginese',
                'name_locale'   => 'Basa Ugi',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/c/c2/South_Sulawesi_coa.png/120px-South_Sulawesi_coa.png',
                'flag_w'        => '120',
                'flag_h'        => '119',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'pih',
                'name_en'       => 'Norfolk',
                'name_locale'   => 'Norfuk',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/4/48/Flag_of_Norfolk_Island.svg/200px-Flag_of_Norfolk_Island.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '100',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'udm',
                'name_en'       => 'Udmurt',
                'name_locale'   => 'Удмурт кыл',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/c/c7/Flag_of_Udmurtia.svg/200px-Flag_of_Udmurtia.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '100',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'nds-nl',
                'name_en'       => 'Dutch Low Saxon',
                'name_locale'   => 'Nedersaksisch',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/0/05/Intersaksische_vlagge_3.svg/200px-Intersaksische_vlagge_3.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'rmy',
                'name_en'       => 'Romani',
                'name_locale'   => 'romani - रोमानी',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/1/10/Flag_of_the_Romani_people.svg/200px-Flag_of_the_Romani_people.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

/*            array(
                'id'            => 'map-bms',
                'name_en'       => 'Banyumasan',
                'name_locale'   => 'Basa Banyumasan',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/d/dc/Lambang_Kabupaten_Banyumas.png/120px-Lambang_Kabupaten_Banyumas.png',
                'flag_w'        => '120',
                'flag_h'        => '122',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'vls',
                'name_en'       => 'West Flemish',
                'name_locale'   => 'West-Vlams',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/c/c2/Flag_of_West_Flanders.svg/200px-Flag_of_West_Flanders.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

/*            array(
                'id'            => 'frp',
                'name_en'       => 'Franco-Provençal/Arpitan',
                'name_locale'   => 'Arpitan',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Flag_of_Arpitania.svg/200px-Flag_of_Arpitania.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '114',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'zh-yue',
                'name_en'       => 'Cantonese',
                'name_locale'   => '粵語',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/8/87/Flag_of_the_City_of_Guangzhou.svg/200px-Flag_of_the_City_of_Guangzhou.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '118',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'xal',
                'name_en'       => 'Kalmyk',
                'name_locale'   => 'Хальмг',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/9/9f/Flag_of_Kalmykia.svg/200px-Flag_of_Kalmykia.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '100',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),

            array(
                'id'            => 'pap',
                'name_en'       => 'Papiamentu',
                'name_locale'   => 'Papiamentu',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/0/0f/Flag_of_the_Netherlands_Antilles_%281959-1986%29.svg/200px-Flag_of_the_Netherlands_Antilles_%281959-1986%29.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

            /*array(
                'id'            => 'pms',
                'name_en'       => 'Piedmontese',
                'name_locale'   => 'Piemontèis',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/b/b9/Flag_of_Piedmont.svg/200px-Flag_of_Piedmont.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

            /*array(
                'id'            => 'kab',
                'name_en'       => 'Kabyle',
                'name_locale'   => 'Taqbaylit',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Berber_flag.svg/200px-Berber_flag.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '133',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            ),*/

            /*array(
                'id'            => 'new',
                'name_en'       => 'Newar / Nepal \'Bhasa',
                'name_locale'   => 'नेपाल भाषा',
                'flag'          => '//upload.wikimedia.org/wikipedia/commons/thumb/c/cc/Flag_of_Kathmandu.svg/200px-Flag_of_Kathmandu.svg.png',
                'flag_w'        => '200',
                'flag_h'        => '135',
                'is_publish'    => false,
                'enable'        => 0,
                'on_admin'      => 0
            )*/)
        );
    }
}