<?php

namespace App\Google\Custom;

use App\Google\Contracts\GoogleFileAdapter;
use App\Google\Traits\FormatFieldsTrait;
use App\Google\Traits\JsonToModel;

class CurlFilesRequest implements GoogleFileAdapter
{
    use FormatFieldsTrait, JsonToModel;

    private \Google_Client $client;

    /**
     * @param \Google_Client $client google client
    */
    function __construct(\Google_Client $client)
    {
        $this->client = $client;
    }

    function getFiles() {
        return $this->retrieveAllFiles();
    }

    function retrieveAllFiles() {
        $nextPageToken = '';
        $fields = '?maxResults=1000'. $nextPageToken .'&fields=items(id,title,fileSize,embedLink,ownerNames,modifiedDate,thumbnailLink),nextPageToken';
        $url = 'https://www.googleapis.com/drive/v2/files' . $fields;
        $headers = [
            'Authorization: Bearer ' . $this->client->getAccessToken()['access_token'],
            'Accept: application/json',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $files = json_decode($response, true);
        $formated_files = $this->formatFields($files['items']);
        //json as model
        return $this->convert($formated_files);
    }
}
