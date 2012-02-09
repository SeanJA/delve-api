<?php

class delve_api {

	public $access_key = "";
	public $secret = "";
	public $org_id = "";
	public $format = 'json';
	public $response = null;
	//5 mins default
	protected $cache_time = 300;

	public function __construct() {
		
	}

	protected function get_request($query, $params = array(), $cache=true) {
		if($this->is_cached($query)){
			$response = $this->get_cached($query);
		} else {
			$url = 'http://api.delvenetworks.com/rest/organizations/' . $this->org_id . $query . '.' . $this->format;

			$signed_get_usage_info_url = Delve_Auth::authenticate_request("GET", $url, $this->access_key, $this->secret, $params);
			$response = file_get_contents($signed_get_usage_info_url);
			if($cache){
				$this->cache_result($query, $response);
			}
		}
		return $this->response = $this->decode($response);
	}
	
	protected function cache_result($query,$result){
		file_put_contents(ROOT.'/cache/'.md5($query), $result);
	}
	
	protected function is_cached($query){
		$file = ROOT.'/cache/'.md5($query);
		$cached = file_exists(ROOT.'/cache/'.md5($query)) && ((filectime(ROOT.'/cache/'.md5($query)) - time()) < $this->cache_time);
		if(!$cached){
			@unlink($file);
		}
		return $cached;
	}
	
	protected function get_cached($query){
		return file_get_contents(ROOT.'/cache/'.md5($query));
	}

	protected function decode($response) {
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
