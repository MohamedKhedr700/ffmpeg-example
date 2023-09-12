<?php

namespace App\Models\Enum;

class Disk
{
    /**
     * The disk name for the video downloads.
     */
    public const DOWNLOAD_VIDEOS = 'download_videos';

    /**
     * The disk name for the video streams.
     */
    public const STREAM_VIDEOS = 'stream_videos';

    /**
     * The disk name for the video uploads.
     */
    public const UPLOAD_VIDEOS = 'upload_videos';
}
