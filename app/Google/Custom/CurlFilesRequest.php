<?php

namespace App\Google\Custom;

use App\Google\Contracts\GoogleFileAdapter;
use App\Google\Traits\CurlHelperTrait;
use App\Google\Traits\FormatFieldsTrait;
use App\Google\Traits\JsonToModel;
use Illuminate\Support\Collection;

class CurlFilesRequest implements GoogleFileAdapter
{
    use FormatFieldsTrait, JsonToModel, CurlHelperTrait;

    private \Google_Client $client;

    /**
     * @param \Google_Client $client google client
    */
    function __construct(\Google_Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return Illuminate\Support\Collection collection of files models
    */
    function getFiles() {
        return $this->retrieveAllFiles();
    }

    function getFilePermissions($fileId) {
        return null;
    }

    function retrieveAllFiles() {
        $nextPageToken = '';
        $fields = '?maxResults=1000'. $nextPageToken .'&fields=items(id,title,fileSize,embedLink,ownerNames,modifiedDate,thumbnailLink),nextPageToken';
        $url = 'https://www.googleapis.com/drive/v2/files' . $fields;
        $headers = [
            'Authorization: Bearer ' . $this->client->getAccessToken()['access_token'],
            'Accept: application/json',
        ];

        $response = $this->makeRequest($url, $headers);
        $files = json_decode($response, true);
        $formated_files = $this->formatFields($files['items']);
        //json as model
        return $this->convert($formated_files);
    }
}
