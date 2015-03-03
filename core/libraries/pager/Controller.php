<?php namespace PageGenerator;

use App;
use Cache;

class Pager {

    /**
     * The application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;


    /**
     * Constructor
     *
     * @return void
     */
    public function __construct($app)
    {
        $this->app = $app;
    }


	/**
	 * display a Page, and his Blocks
	 *
	 * @var Page
	 */
    public function render( $page, $locale_id = null )
    {
        $locale_id = ($locale_id===null?App::getLocale():$locale_id);
        //return var_dump( $page->blocks->first()->blockable->render );
        $view = '<div class="row"><h1 class="page-header">' . $page::getTranslation($page->structure->first()->i18n_title, $locale_id) . '</h1></div>';

        //for all blocks show the content
    	foreach ( $page->blocks as $block ) {
    		$view .= $this->blockable( $block, $locale_id );
		}

        return $view.'<div class="clearfix"></div>';;
    }


	/**
	 * Compose Block DOM
	 *
	 * @var Page
	 */
    public function blockable( $block, $locale_id )
    {
        //cache
        //$content = Cache::remember('block:' . $block->id . '_' . $locale_id, 5, function () use ($block, $locale_id) {
    	    //Compose CSS
        	$css = '';
        	foreach ( $block->responsivesByPriority as $responsive ) {
        		$css .= 'col-' . $responsive->trigger->value . '-' . $responsive->width->value . ' ';
        	}

            //Block Content
        	$content = $block->blockable->renderResource($locale_id);
            
            //Fusiiion
            return '<div class="'.$css.'">'.$content.'</div>';
        //});
        //return $content;
    }
}