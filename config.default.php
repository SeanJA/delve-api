<?php

define('ROOT', __DIR__);

function __autoload($class) {
	$class = str_replace('_', DIRECTORY_SEPARATOR, strtolower($class)) . '.php';
	include ROOT . '/classes/' . $class;
}

define('ACCESS_KEY', '');
define('SECRET', '');
define('ORG_ID', '');

define('YEAR', '31556926');
define('MONTH', '2629744');
define('WEEK', '604800');
define('DAY', '86400');
define('HOUR', '3600');
define('MINUTE', '60');

function fuzzy_span($timestamp, $local_timestamp = NULL) {
	$local_timestamp = ($local_timestamp === NULL) ? time() : (int) $local_timestamp;

	// Determine the difference in seconds
	$offset = abs($local_timestamp - $timestamp);

	if ($offset <= MINUTE) {
		$span = 'moments';
	} elseif ($offset < (MINUTE * 20)) {
		$span = 'a few minutes';
	} elseif ($offset < HOUR) {
		$span = 'less than an hour';
	} elseif ($offset < (HOUR * 4)) {
		$span = 'a couple of hours';
	} elseif ($offset < DAY) {
		$span = 'less than a day';
	} elseif ($offset < (DAY * 2)) {
		$span = 'about a day';
	} elseif ($offset < (DAY * 4)) {
		$span = 'a couple of days';
	} elseif ($offset < WEEK) {
		$span = 'less than a week';
	} elseif ($offset < (WEEK * 2)) {
		$span = 'about a week';
	} elseif ($offset < DAY * 15) {
		$span = 'about a fortnight';
	} elseif ($offset < MONTH) {
		$span = 'less than a month';
	} elseif ($offset < (MONTH * 2)) {
		$span = 'about a month';
	} elseif ($offset < (MONTH * 4)) {
		$span = 'a couple of months';
	} elseif ($offset < (MONTH * 7)) {
		$span = 'about half a year';
	} elseif ($offset < YEAR) {
		$span = 'less than a year';
	} elseif ($offset < (YEAR * 2)) {
		$span = 'about a year';
	} elseif ($offset < (YEAR * 4)) {
		$span = 'a couple of years';
	} elseif ($offset < (YEAR * 8)) {
		$span = 'a few years';
	} elseif ($offset < (YEAR * 12)) {
		$span = 'about a decade';
	} elseif ($offset < (YEAR * 24)) {
		$span = 'a couple of decades';
	} elseif ($offset < (YEAR * 64)) {
		$span = 'several decades';
	} else {
		$span = 'a long time';
	}
	return $span;
}