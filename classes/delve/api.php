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
		if($this->is_cached($query)){
			$response = $this->get_cached($query);
		} else {
			$url = 'http://api.delvenetworks.com/rest/organizations/' . $this->org_id . $query . '.' . $this->format;

			$signed_get_usage_info_url = Delve_Auth::authenticate_request("GET", $url, $this->access_key, $this->secret, $params);
			$response = file_get_contents($signed_get_usage_info_url);
			$this->cache_result($query, $response);
		}
		return $this->response = $this->decode($response);
	}
	
	private function cache_result($query,$result){
		file_put_contents(ROOT.'/cache/'.md5($query), $result);
	}
	
	private function is_cached($query){
		return file_exists(ROOT.'/cache/'.md5($query));
	}
	
	private function get_cached($query){
		return file_get_contents(ROOT.'/cache/'.md5($query));
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
