<?php namespace PageGenerator;

use App;
use Cache;
use View;

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
    public function render( $page, $locale_id = null, $admin_display = false )
    {
        $locale_id = ($locale_id===null?App::getLocale():$locale_id);
        //return var_dump( $page->blocks->first()->blockable->render );
        //$view = '<div class="row"><h1 class="page-header">' . $page::getTranslation($page->structure->first()->i18n_title, $locale_id) . '</h1></div>';
        if ($admin_display) {
            $view = View::make('theme::admin.page.components.page-header-input', array('page' => $page, 'locale_id' => $locale_id ))->render();
        } else {
            $view = View::make('theme::public.pages.components.page-header-type', array('content' => $page::getTranslation($page->structure->first()->i18n_title, $locale_id)))->render();
        }
        
        //for all blocks show the content
    	foreach ( $page->blocks as $block ) {
    		$view .= $this->blockable( $block, $locale_id, $admin_display );
		}

        return $view.'<div class="clearfix"></div>';;
    }


	/**
	 * Compose Block DOM
	 *
	 * @var Page
	 */
    public function blockable( $block, $locale_id, $admin_display )
    {
        //cache
        //$content = Cache::remember('block:' . $block->id . '_' . $locale_id, 5, function () use ($block, $locale_id) {
    	    //Compose CSS
        	$css = '';
        	foreach ( $block->responsivesByPriority as $responsive ) {
        		$css .= 'col-' . $responsive->trigger->value . '-' . $responsive->width->value . ' ';
        	}

            //Block Content
            if ($admin_display && method_exists ($block->blockable, 'renderResourceAdmin')) {
                $content = $block->blockable->renderResourceAdmin($locale_id);
            } elseif (method_exists ($block->blockable, 'renderResource')) {
        	    $content = $block->blockable->renderResource($locale_id);
            } else {
                $content = 'You must do the \'renderResource\' function in ' . $block->blockable_type . ' model';
            }
            
            //Fusiiion
            if ($admin_display && method_exists ($block->blockable, 'renderResourceAdmin')) {
                return '<div class="'.$css.' '.$block->class_css.'"><div class="row">'.$content.'</div></div>';
            } else {
                return '<div class="'.$css.' '.$block->class_css.'">'.$content.'</div>';
            }
        //});
        //return $content;
    }
}