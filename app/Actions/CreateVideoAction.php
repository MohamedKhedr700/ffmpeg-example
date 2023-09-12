<?php

namespace App\Actions;

use App\Jobs\ConvertVideoForDownloading;
use App\Jobs\ConvertVideoForStreaming;
use App\Models\Video;
use Illuminate\Http\UploadedFile;

class CreateVideoAction
{
    /**
     * Video model instance.
     */
    private Video $video;

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
    public function execute(UploadedFile $video, string $title): Video
    {
        $video = $this->video->create([
            'disk' => 'local',
            'original_name' => $video->getClientOriginalName(),
            'path' => $video->store('videos/upload'),
            'title' => $title,
        ]);

        ConvertVideoForStreaming::dispatch($video);

//        ConvertVideoForDownloading::dispatch($video);

        return $video;
    }
}
