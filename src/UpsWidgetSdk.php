<?php

class UPSSDK {
    private $baseURL = 'https://onlinetools.ups.com/security/v1/oauth/token';

    public function __construct() {

    }
	
	public function generateToken($clientId, $clientSecret, $headers = null, $postData = null, $queryParams = null){
		$curl = curl_init();
		$body = '';
		$response = '';
		
		if($postData != null){
			$claims = array();
			$size = count($postData);
			$keys = array_keys($postData);
			for($i = 0; $i < $size; $i++){
				$claims += array($keys[$i] => $postData[$keys[$i]]);
			}
			$body = 'grant_type=1&custom_claims=' . urlencode(json_encode($claims));
		} else {
			$body = 'grant_type=client_credentials';
		}
		
		$curlOptions = array(
            CURLOPT_URL => $this->baseURL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . base64_encode($clientId . ':' . $clientSecret),
                'Content-Type: application/x-www-form-urlencoded',
                'Cookie: ups_language_preference=en_US'
            ),
        );
		
		if($headers != null){
			$size = count($headers);
			$keys = array_keys($headers);
			for($i = 0; $i < $size; $i++){
				array_push($curlOptions[CURLOPT_HTTPHEADER], $keys[$i] . ':' . $headers[$keys[$i]]);
			}
		}
		
		if($queryParams != null){
			foreach($queryParams as $key => $value){
				$this->baseURL = $this->baseURL . '?' . $key . '=' . $value;
			}
		}
		
		curl_setopt_array($curl, $curlOptions);
        $data = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        if($error){
            return $error;
        } else {
			if(str_contains($data, 'access_token')) {
				$response = json_decode($data, true);
				return $response['access_token'];
			} else {
<<<<<<< HEAD
				if(str_contains(strtolower($data), "invalid client id")) {
					throw new Exception($this -> generateError("\"DTG001\""));
				} else if (str_contains(strtolower($data), "missing client id")) {
					throw new Exception($this -> generateError("\"DTG002\""));
				} else if (str_contains(strtolower($data), "invalid client credentials")) {
					throw new Exception($this -> generateError("\"DTG003\""));
				}else if(str_contains(strtolower($data), 'grant')) {
					throw new Exception($this -> generateError("\"DTG004\""));
				} else if(str_contains(strtolower($data), 'redirect')) {
					throw new Exception($this -> generateError("\"DTG005\""));
				} else if(str_contains(strtolower($data), 'authorization code')) {
					throw new Exception($this -> generateError("\"DTG006\""));
				} else if(str_contains(strtolower($data), 'authorization header')) {
					throw new Exception($this -> generateError("\"DTG007\""));
				} else if(str_contains(strtolower($data), 'quota')) {
					throw new Exception($this -> generateError("\"DTG008\""));
				} else {
					throw new Exception($this -> generateError("\"DTG009\""));
				}
			}
        }
	}
	
	private function generateError($code) {
		$initial = "{\"response\":{\"errors\":[{\"code\":";
		$final = ",\"message\":\"Token generation has encountered an error. Please contact your UPS Relationship Manager.\"}]}}";
		$message = $initial . $code . $final;
		return $message;
	}
}