<?php

namespace App\Actions\Video;

use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

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

        return route('video.stream', $video->stream_path);
        //        return $this->prepareStream($video);
    }

    /**
     * Prepare the stream.
     */
    private function prepareStream(Video $video)
    {
        return FFMpeg::dynamicHLSPlaylist($video->stream_disk)
            ->fromDisk($video->stream_disk)
            ->open($video->stream_path)
            ->setKeyUrlResolver(function (string $path) use ($video) {
                return route('video.key', $video->id);
            })
            ->setPlaylistUrlResolver(function (string $path) use ($video) {
                return route('video.stream', $video->id);
            })
            ->setMediaUrlResolver(function (string $path) use ($video) {
                return Storage::disk($video->stream_disk)->url($path);
            });
    }
}
