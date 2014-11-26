<?php

class Block extends Eloquent{
	
	/**
	 * Parameters
	 */
	protected $table = 'blocks';


	/**
	 * Relations
	 *
	 * @var string
	 */
	public function page() {
        return $this->hasOne('Page');
    }

    public function type() {
        return $this->hasOne('Type');
    }

	public function responsives() {
        return $this->hasMany('Responsive');
    }

    public function responsivesByPriority()
    {
    	return $this->responsives()
    		->join('responsive_triggers','block_responsive.responsive_trigger_id','=','responsive_triggers.id')
    		->join('responsive_widths','block_responsive.responsive_width_id','=','responsive_widths.id')
    		->orderBy('responsive_triggers.priority','ASC');
	}


	/**
	 * Polymorphic relation
	 *
	 * @var string
	 */
	public function blockable()
    {
        return $this->morphTo();
    }
    public function trackable()
    {
        return $this->morphTo();
    }


    public static function add($pageId, $order, $blockType)
    {
        $previousBlock = self::where('page_id', $pageId)
                              ->where('blockable_type', $blockType)
                              ->orderBy('blockable_id', 'DESC')
                              ->first();    
        $block = new self;
        $block->blockable_id = $previousBlock->blockable_id+1;
        $block->blockable_type = $blockType;
        $block->page_id = $pageId;
        $block->order = $order;
        $block->save();
        return $block;
    }


    /**
     * Attributes
     *
     * @return mixed
     */
}