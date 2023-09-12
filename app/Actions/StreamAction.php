<?php

namespace App\Actions;

use Illuminate\Support\Facades\Storage;

class StreamAction
{
    /**
     * Execute the action.
     */
    public function execute(string $video)
    {
        $videoPath = $this->getVideoPath($video);

        return response()->file($videoPath, [
            'Content-Type' => 'application/x-mpegURL',
            'isHls' => true,
        ]);
    }

    /**
     * Get the video.
     */
    private function getVideoPath(string $video): string
    {
        return Storage::path('videos/'.$video.'.m3u8');
    }
}
