<?php

namespace Dynamix\Models;

use Illuminate\Database\Eloquent\Model;

class AdminNavigationGroup extends Model {

	/**
	 * Parameters
	 */
	protected $table = 'admin_navigation_groups';

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
	public function title()
	{
		return \Eloquentizr::getTranslation($this->i18n_title);
	}
    
    /**
     * Herited attributes
     *
     * @return mixed
     */
}
