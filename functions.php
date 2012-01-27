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
	
	//there is probably a nicer way to do this...
	$seconds = floor($milliseconds / 1000);
	$years = floor($seconds / YEAR);
	$seconds -= ($years * YEAR);
	$months = floor($seconds / MONTH);
	$seconds -= ($months * MONTH);
	$weeks = floor($seconds / WEEK);
	$seconds -= ($weeks * WEEK);
	$days = floor($seconds / DAY);
	$seconds -= ($days * DAY);
	$hours = floor($seconds / HOUR);
	$seconds -= ($hours * HOUR);
	$minutes = floor($seconds / MINUTE);
	$seconds -= ($minutes * MINUTE);
	
	$return = '';
	if($years){
		$return .= $years .' years '; 
	}
	if($months){
		$return .= $months .' months '; 
	}
	if($weeks){
		$return .= $weeks .' weeks '; 
	}
	if($days){
		$return .= $days .' days '; 
	}
	if($hours){
		$return .= $hours .' hours '; 
	}
	if($minutes){
		$return .= $minutes .' minutes '; 
	}
	if($seconds){
		$return .= $seconds .' seconds '; 
	}
	return $return;
}
