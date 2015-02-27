<?php
//not eloquent
class Wysiwyg {
	
	/**
	 * Parameters
	 */
	//Blockable
    public static $blockable_type = 'Wysiwyg';
	
	/**
	 * Relations
	 *
	 * @var string
	 */


    /**
     * Attributes
     *
     * @return mixed
     */


    /**
     * Attributes
     *
     * @return mixed
     */
    public static function getFreeObjects()
    {       
    	//get objects not free in block table
    	$model = get_class(new self);
    	$blocks_not_free = Block::where('blockable_type', $model)->select('blockable_id')->get();
    	$items = $model::select('id')->get();
    	$block_ids = array();
    	foreach ($blocks_not_free as $block) {
    		$block_ids[] = $block->blockable_id;
    	}

    	$data =array();
    	foreach ($items as $item) {
    		if (!in_array($item->id, $block_ids)) $data[] = $item;
    	}
    	return $data;
    }

    /**
     * #Pager method
     *
     * @return mixed
     */
    public function renderResource()
    {
    	$data['form'] = $this;
    	$data['inputs'] = Former::render($data['form']);
        return Response::view('public.form.form', $data )->getOriginalContent();
    }

	/**
	 * Additional Method
	 *
	 * @var string
	 */
	public function translate( $i18n_id )
	{
		return Translation::where('i18n_id','=',$i18n_id)->where('locale_id','=',App::getLocale())->first()->text;
	}
}