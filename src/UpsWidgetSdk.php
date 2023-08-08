<?php

class UPSSDK {
    private $baseURL;
    private $clientId;
    private $clientSecret;

    public function __construct($clientId, $clientSecret, $baseURL = null) {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->baseURL = $baseURL ?? 'https://onlinetools.ups.com/security/v1/oauth/token';
    }

    public function generateToken($sessionId = null, $customClaims = null) {

        $curl = curl_init();

        $postData = '';

        if($sessionId != null){ //Locator
            if($customClaims != null){
                $claims = ['sessionid' => $sessionId];
                //test
                echo count($claims);
                $size = count($customClaims);
                $keys = array_keys($customClaims);

                for($i = 0; $i < $size; $i++){
                    $claims += array($keys[$i] => $customClaims[$keys[$i]]);
                }
                $postData = 'grant_type=1&custom_claims=' . urlencode(json_encode($claims));
            }

            $postData = 'grant_type=1&custom_claims=' . urlencode(json_encode(['sessionid' => $sessionId]));
        } else { //Returns
            $postData = 'grant_type=1';
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
                CURLOPT_POSTFIELDS => $postData,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret),
                    'Content-Type: application/x-www-form-urlencoded',
                    'Cookie: ups_language_preference=en_US'
                ),
            );

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

