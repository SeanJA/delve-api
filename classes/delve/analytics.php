<?php

class delve_analytics extends delve_authenticated {
	public $prefix = '/analytics/';
	//1 hour
	protected $cache_time = 3600;
	public function __call($name, $arguments) {
		$name = strtolower($name);
		$query = $this->prefix.str_replace('_', '/', $name);
		$params = isset($arguments[0])? $arguments[0] : array();
		return $this->get_request($query, $params);
	}
}