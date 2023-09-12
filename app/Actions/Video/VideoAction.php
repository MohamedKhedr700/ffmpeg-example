<?php

namespace App\Actions\Video;

use App\Models\Video;

abstract class VideoAction
{
    /**
     * Video model instance.
     */
    protected Video $video;

    /**
     * Create a new action instance.
     */
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Get the video model instance.
     */
    public function video(): Video
    {
        return $this->video;
    }
}
