<?php

namespace App\Google\Traits;

use App\Models\DriveFile;

trait JsonToModel
{
    /**
     * @param array $jsonArray evaluate file models from json array
     * @return Illuminate\Support\Collection collection of files models
    */
    public function convert($jsonArray){
        // $object = (array)json_decode($data);
        $collection = DriveFile::hydrate($jsonArray);
        $collection = $collection->flatten();
        return $collection;
    }
}
