<?php

class BlockResponsive extends Eloquent 
{
	
	/**
	 * Table name
	 * @var string
	 */
	protected $table = 'block_responsive';
	/**
	 * Disable Timestamps
	 * @var boolean
	 */
	public $timestamps = false;

	/**
	 * Add a new BlockResponsive
	 * @param Integer $blockId             
	 * @param Integer $responsWithId       
	 * @param Integer $responsiveTriggerId 
	 */
	public static function add($blockId, $responsWithId, $responsiveTriggerId)
	{
		$BR = new self;
		$BR->block_id = $blockId;
		$BR->responsive_width_id = $responsWithId;
		$BR->responsive_trigger_id = $responsiveTriggerId;
		$BR->save();
		return $BR;
	}

}