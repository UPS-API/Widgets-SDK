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
			$body = 'grant_type=client_credentials&custom_claims=' . urlencode(json_encode($claims));
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
        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        if($error){
            return $error;
        } else {
            return $response;
        }
	}
}