<?php

class delve_api {

	public $access_key = "";
	public $secret = "";
	public $org_id = "";
	public $format = 'json';
	public $response = null;

	public function __construct() {
		
	}

	protected function get_request($query, $params = array()) {
		$url = 'http://api.delvenetworks.com/rest/organizations/' . $this->org_id . $query . '.' . $this->format;

		$signed_get_usage_info_url = Delve_Auth::authenticate_request("GET", $url, $this->access_key, $this->secret, $params);
		$response = file_get_contents($signed_get_usage_info_url);
		return $this->response = $this->decode($response);
	}

	public function decode($response) {
		switch ($this->format) {
			case 'json':
				return json_decode($response);
				break;
			default:
				return $response;
				break;
		}
	}

}
