<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Video extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'original_name',
        'disk',
        'path',
        'stream_disk',
        'stream_strategy',
        'stream_path',
        'streamable_at',
        'streamable',
        'download_path',
        'downloadable_at',
        'downloadable',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $dates = [
        'streamable_at',
        'downloadable_at',
    ];
}
