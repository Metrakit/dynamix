<?php namespace PageGenerator;

class Pager {

    /**
     * The application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;


    /**
     * Create a new manager instance.
     *
     * @param  \Illuminate\Foundation\Application  $app
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
    public function render( $page )
    {
        //return var_dump( $page->blocks->first()->blockable->render );
        $view = '';

        //for all blocks show the content
    	foreach( $page->blocks as $block )
    	{
    		$view .= $this->blockable( $block );
		}

        return $view;
    }


	/**
	 * Compose Block DOM
	 *
	 * @var Page
	 */
    public function blockable( $block )
    {
    	//Compose CSS
    	$css = '';
    	foreach( $block->responsivesByPriority as $responsive )
    	{
    		$css .= 'col-' . $responsive->trigger->value . '-' . $responsive->width->value . ' ';
    	}

        //Block Content
    	$content = $block->blockable->first()->renderResource();

        //Fusiiion
        return '<div class="'.$css.'">'.$content.'</div>';
    }
}