<?php

namespace App\Google\Custom;

use App\Google\Contracts\GoogleFileAdapter;
use App\Google\Traits\FormatFieldsTrait;
use App\Google\Traits\JsonToModel;
use Carbon\Carbon;

class FunctionFilesRequest implements GoogleFileAdapter
{
    use FormatFieldsTrait, JsonToModel;

    private \Google_Client $client;
    private \Google_Service_Drive $driveService;

    /**
     * @param \Google_Client $client Google Client
    */
    function __construct(\Google_Client $client)
    {
        $this->client = $client;
        $this->driveService = new \Google_Service_Drive($this->client);
    }

    /**
     * @return Illuminate\Support\Collection collection of files models
    */
    function getFiles() {
        $files = $this->retrieveAllFiles();
        $filesinfo = [];
        foreach($files as $file) {
            $owners = [];
            foreach($file->owners as $owner) {
                $owners[] = $owner->displayName;
            }
            $filea = [
                'id' => $file->id,
                'title' => $file->getName(),
                'ownerNames' => $owners,
                'thumbnailLink' => $file->thumbnailLink,
                'embedLink' => $file->webViewLink,
                'modifiedDate' => Carbon::parse($file->modifiedTime)->format('d-m-Y'),
                'fileSize' => $file->size
            ];

            $filesinfo[] = $filea;
        }

        $formated_files = $this->formatFields($filesinfo);
        //json as model
        return $this->convert($formated_files);
    }

    function getFilePermissions($fileId) {
        // try {
        //   $permissions = $this->driveService->permissions->listPermissions($fileId);
        //   return $permissions;
        // } catch (\Exception $e) {
        //   print "An error occurred: " . $e->getMessage();
        // }
        // return NULL;
    }

    function retrieveAllFiles() {
        $result = array();
        $pageToken = NULL;

        do {
            try {
                $parameters = array();

                if ($pageToken) {
                    $parameters['pageToken'] = $pageToken;
                }

                $parameters['pageSize'] = 20;
                $parameters['fields'] = 'files(id, name, size, modifiedTime, thumbnailLink, webContentLink, webViewLink, owners),nextPageToken';
                $files = $this->driveService->files->listFiles($parameters);
                $result = array_merge($result, $files->getFiles());
                $pageToken = $files->getNextPageToken();
            } catch (\Exception $e) {
                print "An error occurred: " . $e->getMessage();
                $pageToken = NULL;
            }
        } while ($pageToken);

        return $result;
    }
}
