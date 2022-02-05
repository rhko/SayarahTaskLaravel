<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriveFile extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'embedLink', 'thumbnailLink', 'title', 'modifiedDate', 'fileSize', 'ownerNames'];
}
