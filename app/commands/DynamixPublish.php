<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DynamixPublish extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'dynamix:publish';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Publish a Dynamix package';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$moduleName = $this->option('module');
		if ($moduleName) {
			$this->info("The module '$moduleName' was successfully published !");
			Artisan::call("asset:publish", array(
				"--path" => "vendor/dynamix/$moduleName/public", 
				"--dest"   => "../../dev/src/packages/$moduleName")
			);
		}
		
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			//array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('module', 'm', InputOption::VALUE_OPTIONAL, 'A module name', null),
		);
	}

}
