<?php

namespace App\Actions;

use App\Models\Video;

class FindVideoAction
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
     * Execute the action.
     */
    public function execute(string $id): ?Video
    {
        return $this->video->find($id);
    }
}
