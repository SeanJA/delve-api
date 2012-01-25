<?php

//DelveAuthUtil v1.1 10-Feb-10
//This file is offered as a convenient utility to authenticate requests 

class delve_auth {

	function authenticate_request($http_verb, $resource_url, $access_key, $secret, $params = null) {
		$parsed_url = parse_url($resource_url);
		$str_to_sign = strtolower($http_verb . '|' . $parsed_url['host'] . '|' . $parsed_url['path']) . '|';
		$url = $resource_url . '?';

		if ($params == null)
			$params = array();
		if (!array_key_exists('expires', $params))
			$params['expires'] = time() + 300;
		$params['access_key'] = $access_key;

		$keys = array_keys($params);
		sort($keys);

		foreach ($keys as $key) {
			$str_to_sign .= $key . '=' . $params[$key] . '&';
			$url .= rawurlencode($key) . '=' . rawurlencode($params[$key]) . '&';
		}

		$str_to_sign = chop($str_to_sign, '&');
		$signature = base64_encode(hash_hmac('sha256', $str_to_sign, $secret, true));
		$url .= 'signature=' . rawurlencode($signature);

		return $url;
	}

}