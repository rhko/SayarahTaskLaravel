<?php

namespace App\Google\Contracts;

interface GoogleFileAdapter
{
    function getFiles();

    function getFilePermissions($fileId);
}
