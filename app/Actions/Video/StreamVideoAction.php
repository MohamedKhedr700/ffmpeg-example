<?php

namespace App\Actions\Video;

class StreamVideoAction
{
    /**
     * The FindVideoAction instance.
     */
    private FindVideoAction $findVideoAction;

    /**
     * Create a new action instance.
     */
    public function __construct(FindVideoAction $findVideoAction)
    {
        $this->findVideoAction = $findVideoAction;
    }

    /**
     * Execute the action.
     */
    public function execute(string $id)
    {
        $video = $this->findVideoAction->execute($id);

        if (! $video) {
            return null;
        }
        dd($video);
    }

    /**
     * Get the video.
     */
    private function getVideoPath(string $video): string
    {
    }
}
