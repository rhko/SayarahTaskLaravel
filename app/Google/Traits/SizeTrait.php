<?php

namespace App\Google\Traits;

trait SizeTrait
{
    /**
     * @param int $bytes file size in bytes to be convert to readable format
    */
    public function getReadableSize($bytes){
        if ($bytes >= 1073741824) {
            $size = number_format($bytes / 1073741824, 2) . ' GB';
        } else if ($bytes >= 1048576) {
            $size = number_format($bytes / 1048576, 2) . ' MB';
        } else if ($bytes >= 1024) {
            $size = number_format($bytes / 1024, 2) . ' KB';
        } else if ($bytes > 1) {
            $size = $bytes . ' bytes';
        } else if ($bytes == 1) {
            $size = $bytes . ' byte';
        } else {
            $size = '0 bytes';
        }

        return $size;
    }
}
