<?php

class delve_channels extends delve_authenticated{
	private $prefix = '/channels/';
	//1 day default
	protected $cache_time = 86400;
	public function __call($name, $arguments) {
		$name = strtolower($name);
		$query = $this->prefix.str_replace('_', '/', $name);
		$params = isset($arguments[0])? $arguments[0] : array();
		return $this->get_request($query, $params);
	}
}