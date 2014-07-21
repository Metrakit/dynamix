<?php

class Block extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'blocks';

	/**
     * A Blog has many Permission
     *
     * @return mixed
     */
	public function page() {
        return $this->hasOne('Page');
    }

}