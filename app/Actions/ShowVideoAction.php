<?php

namespace App\Actions;

use App\Models\Video;

class ShowVideoAction
{
    /**
     * Create a new action instance.
     */
    public function __construct(
        private readonly Video $video,
    ) {
    }

    /**
     * Execute the action.
     */
    public function execute(string $id): ?Video
    {
        return $this->video->find($id);
    }
}
