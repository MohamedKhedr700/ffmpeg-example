<?php

namespace App\Actions;

use App\Jobs\ConvertVideoForStreaming;
use App\Models\Enum\Disk;
use App\Models\Video;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;

class CreateVideoAction
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
    public function execute(UploadedFile $video, string $title): Video
    {
        $uploadPath = Carbon::today()->format('Y-m-d');

        $video = $this->video->create([
            'disk' => Disk::UPLOAD_VIDEOS,
            'original_name' => $video->getClientOriginalName(),
            'path' => $video->store($uploadPath, Disk::UPLOAD_VIDEOS),
            'title' => $title,
        ]);

        ConvertVideoForStreaming::dispatch($video);

        //        ConvertVideoForDownloading::dispatch($video);

        return $video;
    }
}
