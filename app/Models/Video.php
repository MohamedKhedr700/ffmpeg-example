<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'converted_for_streaming_at',
        'converted_for_downloading_at',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $dates = [
        'converted_for_downloading_at',
        'converted_for_streaming_at',
    ];
}
