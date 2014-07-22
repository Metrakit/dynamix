<?php

use \Illuminate\View\ViewServiceProvider;

class CustomViewServiceProvider extends ViewServiceProvider
{
    /**
	 * Register the view finder implementation.
	 *
	 * @return void
	 */
	public function registerViewFinder()
	{
		$this->app->bindShared('view.finder', function($app)
		{
			$paths = $app['config']['view.paths'];

			return new CustomFileViewFinder($app['files'], $paths);
		});
	}
}

