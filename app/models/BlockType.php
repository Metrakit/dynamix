<?php

class BlockType extends Eloquent{
	
	/**
	 * Table name
	 */
	protected $table = 'block_types';
	/**
	 * Disable Timestamps
	 * @var boolean
	 */
	public $timestamps = false;

	
	/**
	 * Relations
	 *
	 * @var string
	 */


	/**
	 * Polymorphic relation
	 *
	 * @var string
	 */
	public function blocks()
    {
        return $this->hasMany('Block');
    }
    


    /**
     * Attributes
     *
     * @return mixed
     */


	/**
	 * Additional Method
	 *
	 * @var string
	 */

}