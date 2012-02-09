<?php

class delve_authenticated extends delve_api {

	public $access_key = "";
	public $secret = "";
	//5 mins default
	protected $cache_time = 300;

	public function get_request($query, $params = array(), $cache=true) {
		if($this->is_cached($query)){
			$response = $this->get_cached($query);
		} else {
			$url = 'http://api.delvenetworks.com/rest/organizations/' . $this->org_id . $query . '.' . $this->format;

			$signed_get_usage_info_url = Delve_Auth::authenticate_request("GET", $url, $this->access_key, $this->secret, $params);
			$response = file_get_contents($signed_get_usage_info_url);
			if($cache && $response){
				$this->cache_result($query, $response);
			}
		}
		return $this->response = $this->decode($response);
	}
}