<?php

/**
 * Dependency Manager - Dynamix
 * @version 1.0
 * @example DependencyManager::init(modules);
 * @author David LEPAUX <d.lepaux@gmail.com>
 * @author Jordane JOUFFROY <contact@jordane.net>
 */
class DependencyManager {

	/**
	 * Listing of modules needed
	 * @var array
	 */
	private $dependencies = array();

	/**
	 * @param array $dependencies modules needed
	 */
	public function __construct($dependencies)
	{
		if (!is_array($dependencies)) {
			throw new InvalidArgumentException("The depencyManager need an array in argument !", 1);
		}

		$this->dependencies = $dependencies;

		$result = $this->check();

		if (sizeof($result)) {
			$this->displayErrors($result);
		}
	}

	/**
	 * Initialise the dependency manager
	 * @param  array $data [description]
	 */
	public static function init($data = NULL)
	{
		if ($data == NULL) {
			throw new InvalidArgumentException("You should add the modules needed in a array as argument in the DependencyManager. You can add an empty array if no modules are needed", 1);
		}
		$self = new self($data);
	}

	/**
	 * Check if all the dependencies needed are there
	 * @return array listing of errors if any.
	 */
	public function check()
	{
		$errors = array();
		foreach ($this->dependencies as $dependency) {
			if (!class_exists($dependency)) {
				$errors[] = $dependency;
			}
		}
		return $errors;
	}

	/**
	 * Display the errors
	 * @param  array $errors Class names
	 */
	public function displayErrors($errors)
	{
		if (sizeof($errors) == 0) return NULL;
		echo '<div style="text-align:center">';
		echo '<h1 style="color:red;margin-bottom:50px;">Dynamix - Module error</h1>';
		echo '<ul>';
		foreach ($errors as $moduleName) {
			echo '<li>The module <strong>' . $moduleName . '</strong> is needed</li>';
		}
		echo '</ul>';
		echo '</div>';
		// We stop the application here ! 
		die;
	}

}