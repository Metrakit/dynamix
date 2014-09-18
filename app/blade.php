<?php

/*
*
* Bootstrap Macros
* 
 */

// WARNING
Blade::extend(function($value) {
	return preg_replace("/<success>/", "<?php echo '<div class=\"alert alert-success\">' ?>", $value);
});
Blade::extend(function($value) {
	return preg_replace("/<success closable>/", "<?php echo '<div class=\"alert alert-success alert-dismissible\" data-ng-hide=\"dismissAlert\"  role=\"alertSuccess\"> <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>' ?>", $value);
});

Blade::extend(function($value) {
	return preg_replace("/<\/success>/", "<?php echo '</div>' ?>", $value);
});


// INFO
Blade::extend(function($value) {
	return preg_replace("/<info>/", "<?php echo '<div class=\"alert alert-info\">' ?>", $value);
});
Blade::extend(function($value) {
	return preg_replace("/<info closable>/", "<?php echo '<div class=\"alert alert-info alert-dismissible\" role=\"alert\"> <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>' ?>", $value);
});

Blade::extend(function($value) {
	return preg_replace("/<\/info>/", "<?php echo '</div>' ?>", $value);
});

// WARNING
Blade::extend(function($value) {
	return preg_replace("/<warning>/", "<?php echo '<div class=\"alert alert-warning\">' ?>", $value);
});
Blade::extend(function($value) {
	return preg_replace("/<warning closable>/", "<?php echo '<div class=\"alert alert-warning alert-dismissible\"  role=\"alert\"> <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>' ?>", $value);
});

Blade::extend(function($value) {
	return preg_replace("/<\/warning>/", "<?php echo '</div>' ?>", $value);
});

// DANGER
Blade::extend(function($value) {
	return preg_replace("/<danger>/", "<?php echo '<div class=\"alert alert-danger\">' ?>", $value);
});
Blade::extend(function($value) {
	return preg_replace("/<danger closable>/", "<?php echo '<div class=\"alert alert-danger alert-dismissible\"  role=\"alert\"> <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>' ?>", $value);
});

Blade::extend(function($value) {
	return preg_replace("/<\/danger>/", "<?php echo '</div>' ?>", $value);
});
