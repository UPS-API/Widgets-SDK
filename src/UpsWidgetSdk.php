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

    public function generateToken($sessionId, $additionalHeaders = null) {

        $postData = 'grant_type=1&custom_claims=' . urlencode(json_encode(['sessionid' => $sessionId]));

        $curl = curl_init();

        //Default Options
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

        //Add Additional Headers
        if($additionalHeaders != null){

            if(array_is_list($additionalHeaders)){
                for($i = 0; $size = count($additionalHeaders), $i < $size; $i++){
                    array_push($curlOptions[CURLOPT_HTTPHEADER], $additionalHeaders[$i]);
                }
            } else {
                $keys = array_keys($additionalHeaders);
                for($i = 0; $size = count($keys), $i < $size; $i++){
                    array_push($curlOptions[CURLOPT_HTTPHEADER], $keys[$i] . ': ' . $additionalHeaders[$keys[$i]]);
                }
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

    /* OLD
    public function generateToken($sessionId) {
        $postData = 'grant_type=1&custom_claims=' . urlencode(json_encode(['sessionid' => $sessionId]));

        $curl = curl_init();
        curl_setopt_array($curl, array(
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
                'Cookie: ups_language_preference=fr_CA'
            ),
        ));
        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        if ($error) {
            return $error;
        } else {
            return $response;
        }
    }*/
}

