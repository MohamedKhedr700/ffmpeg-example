<?php

namespace App\Actions;

use FFMpeg\Format\Video\X264;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

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
        return Storage::path('videos/' . $video . '.m3u8');
    }
}
