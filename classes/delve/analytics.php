<?php

class delve_analytics extends delve_api {
	public $prefix = '/analytics/';
	public function __call($name, $arguments) {
		$name = strtolower($name);
		$query = $this->prefix.str_replace('_', '/', $name);
		$params = isset($arguments[0])? $arguments[0] : array();
		return $this->get_request($query, $params);
	}
}