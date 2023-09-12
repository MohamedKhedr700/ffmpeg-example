<?php

namespace App\Actions;

use App\Models\Video;
use Illuminate\Http\UploadedFile;

class CreateVideoAction
{
    /**
     * Create a new action instance.
     */
    public function __construct(
        private readonly Video $video,
        private readonly ConvertForStreamAction $convertForStreamAction,
        private readonly ConvertForDownloadAction $convertForDownloadAction
    ) {
    }

    /**
     * Execute the action.
     */
    public function execute(UploadedFile $video, string $title): Video
    {
        $video = $this->video->create([
            'disk' => 'videos_disk',
            'original_name' => $video->getClientOriginalName(),
            'path' => $video->store('upload', 'videos_disk'),
            'title' => $title,
        ]);

        //        $this->convertForStreamAction->execute($video);

        //        $this->convertForDownloadAction->execute($video);

        return $video;
    }
}
