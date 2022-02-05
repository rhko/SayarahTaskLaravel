<?php

namespace App\Google\Traits;

use Carbon\Carbon;

trait FormatFieldsTrait
{
    use SizeTrait;

    /**
     * @param array $filesList list of files to reformat fields
     * @return array formated files list
    */
    public function formatFields($filesList){
        array_walk ($filesList, function (&$key) {
            if (isset($key['fileSize'])) {
                $key["fileSize"] = $this->getReadableSize($key["fileSize"]);
            }
            $key['modifiedDate'] = Carbon::parse($key["modifiedDate"])->format('d-m-Y');
            $key["ownerNames"] = implode(',', $key['ownerNames']);
        });

        return $filesList;
    }
}
