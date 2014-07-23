<?php namespace PageGenerator;

class Pager {

	/**
	 * display a Page, and his Blocks
	 *
	 * @var Page
	 */
    public function render( $eloquent )
    {
        //test if is a Page Object
        if( get_class( $eloquent ) == 'Page' )
        {
        	$view = '';

        	//for all blocks show the content
        	foreach( $eloquent->blocks as $block )
        	{
        		$view .= $this->displayBlock( $block );
			}

        	return $view;
        }
    }


	/**
	 * display a Block
	 *
	 * @var Page
	 */
    public function displayBlock( $block )
    {
    	//Compose CSS
    	$css = '';
    	foreach( $block->responsives as $responsive )
    	{
    		$css .= 'col-' . $responsive->trigger->value . '-' . $responsive->width->value . ' ';
    	}

    	$content = $block->translate( $block->i18n_content );

        return '<div class="'.$css.'">'.$content.'</div>';
    }



}