<?php
define('ROOT', __DIR__);
define('YEAR', '31556926');
define('MONTH', '2629744');
define('WEEK', '604800');
define('DAY', '86400');
define('HOUR', '3600');
define('MINUTE', '60');
function __autoload($class) {
	$class = str_replace('_', DIRECTORY_SEPARATOR, strtolower($class)) . '.php';
	include ROOT . '/classes/' . $class;
}
function time_wasted($milliseconds) {
	$span = sprintf("%d hours, %d minutes and %d seconds\n", (int) $milliseconds / (1000 * 60 * 60), (int) $milliseconds / (1000 * 60), (int) $milliseconds / 1000);
	return $span;
}
