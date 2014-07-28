<?php namespace PageGenerator;

class Pager {

	/**
	 * display a Page, and his Blocks
	 *
	 * @var Page
	 */
    public function render( $page )
    {
        //test if is a Page Object
        if( get_class( $page ) == 'Page' )
        {
        	$view = '';

        	//for all blocks show the content
        	foreach( $page->blocks as $block )
        	{
        		$view .= $this->displayBlock( $block );
			}

        	return $view;
        }
    }


	/**
	 * Compose Block DOM
	 *
	 * @var Page
	 */
    public function displayBlock( $block )
    {
    	//Compose CSS
    	$css = '';
    	foreach( $block->responsivesByPriority as $responsive )
    	{
    		$css .= 'col-' . $responsive->trigger->value . '-' . $responsive->width->value . ' ';
    	}

        //Content Block
    	$content = $block->translate( $block->i18n_content );

        //Fusiiion
        return '<div class="'.$css.'">'.$content.'</div>';
    }
}