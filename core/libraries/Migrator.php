<?php

use Symfony\Component\HttpFoundation\File\Exception;

/**
 * Migration Generator - Dynamix
 * @version 1.0
 * @example $migrator->generate()
 * @author David LEPAUX <d.lepaux@gmail.com>
 * @author Jordane JOUFFROY <contact@jordane.net>
 */
class Migrator
{

	/**
	 * Model name
	 * @var string
	 */ 
	private $migrateName;
	/**
	 * Data array
	 * @var array
	 */
	private $data = array();
	/**
	 * Path of migrates folder
	 * @var string
	 */
	private $migratePath = "";

	/**
	 * File name
	 * @var string
	 */
	private $fileName;

	/**
	 * Constructor
	 * @param string $migrateName  Name of the model
	 * @param array $data       Array of values for generate the migration file
	 * @param string $migratePath  Path of migrates folder
	 */
	public function __construct($migrateName, $data, $migratePath = NULL)
	{
		if ($migratePath) {
			$this->migratePath = $migratePath;
		} else {
			$this->migratePath = app_path() . '/database/migrations/';
		}

		if (!is_string($data)) {
			throw new InvalidArgumentException('$data renseigned in the Migrator should be a string !', 1);			
		}
		if (!is_string($migrateName)) {
			throw new InvalidArgumentException('$migrateName renseigned in the Migrator should be a string !', 1);			
		}

		$this->migrateName = $migrateName;
		$this->data = $data;
	}

	/**
	 * Generate the Migrate file
	 * @return Artisan
	 */
	public function generate()
	{
		Artisan::call("migrate:make", array(
			"name" => "create_table_$this->migrateName", 
			"--create" => $this->migrateName)
		);

		$this->fileName = $this->getNewFile();

		if ((!$content = file_get_contents($this->migratePath . $this->fileName))) {
			throw new FileException('No content found in the migration file !', 1);	
		}

		if ($this->updateFile($content)) {				
			return Artisan::call("migrate");
		}

	}

	/**
	 * Update a file content
	 * @param  string $content
	 * @return boolean
	 */
	public function updateFile($content)
	{
		$countChars = $this->findEmplacement($content);
		$before = mb_substr($content, 0, $countChars);
		$after = mb_substr($content, $countChars);

		try {
			$file = fopen($this->migratePath . $this->fileName, 'w+'); 
		} catch (FileException $e) {
			throw new FileException("File not found" . $e->getMessage(), 1);			
		}
		
		fwrite($file, $before);
		fwrite($file, "\r\n");
		fwrite($file, $this->data);
		fwrite($file, "\r\n");
		// add 3 tabs
		fwrite($file, "\t\t\t");
		fwrite($file, $after);  
		fclose($file); 

		return true;
	}

	/**
	 * Get the new migrate file in the migrate folder
	 * @return File
	 */
	public function getNewFile()
	{
		$files = scandir($this->migratePath, SCANDIR_SORT_DESCENDING);
		if (!sizeof($files)) {
			throw new FileException('No migration files found in the migrates directory !', 1);		
		}
		return $files[0];
	}

	/**
	 * Find the emplacement where put the content
	 * @param string $content
	 * @return integer
	 */
	public function findEmplacement($content)
	{
		$toFind = '$table->timestamps();';
		return stripos($content, $toFind);
	}

}

