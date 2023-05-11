<?php

namespace HaruyaNishikubo\AllInOneDx\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadFileInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mime_type',
        'original_name',
        'file_size',
        'path_name',
    ];
}
