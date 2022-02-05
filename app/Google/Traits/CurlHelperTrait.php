<?php

namespace App\Google\Traits;

trait CurlHelperTrait
{
    /**
     * make http request via curl
     * @param string $url request url
     * @param array $headers request headers as array
     * @return string response string
    */
    public function makeRequest($url, $headers){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}
