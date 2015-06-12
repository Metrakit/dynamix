<?php

class Rerouter extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = '301';
	public static $presenter = 'admin.page.presenter';
	public static $rscName = 'admin.rscPage';
	public static $blockContentView = 'public.pages.page';
	public static $langNav = 'admin.nav_page';

	static public function get($source) {
		return null;
	}

	public static function allCached () {
		if (Cache::has('DB_Reroutes')) {
			return Cache::get('DB_Reroutes');
		}
		$reroutes = self::all();
		Cache::forever('DB_Reroutes', $reroutes);
		return $reroutes;
	}

}