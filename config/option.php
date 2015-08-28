<?php

	/*if (Schema::hasTable('options'))
	{
		return Cache::rememberForever('options', function()
		{
			$get_options = Option::all();

			$options = array();

			foreach ($get_options as $option) {
				$options[$option->key] = $option->value;
			}

		    return $options;
		});
	}

	// If the table doesnt exist we return a empty array
	return array();*/