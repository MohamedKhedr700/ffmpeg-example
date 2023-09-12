<?php

namespace App\Actions\Video;

use App\Jobs\ConvertVideoForStreaming;
use App\Models\Video;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;

class CreateVideoAction extends VideoAction
{
    /**
     * Execute the action.
     */
    public function execute(UploadedFile $video, string $title): Video
    {
        $uploadDisk = 'upload_videos';

        $uploadPath = Carbon::today()->format('Y-m-d');

        $video->store($uploadPath, $uploadDisk);

        $video = $this->video()->create([
            'disk' => $uploadDisk,
            'original_name' => $video->getClientOriginalName(),
            'path' => $uploadPath,
            'title' => $title,
        ]);

        ConvertVideoForStreaming::dispatch($video);

//        ConvertVideoForDownloading::dispatch($video);

        return $video;
    }
}
