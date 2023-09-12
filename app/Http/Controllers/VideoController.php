<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoRequest;
use App\Jobs\ConvertVideoForDownloading;
use App\Jobs\ConvertVideoForStreaming;
use App\Models\Video;
use Illuminate\Http\JsonResponse;

class VideoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function __invoke(StoreVideoRequest $request): JsonResponse
    {
        $video = Video::create([
            'disk' => 'videos_disk',
            'original_name' => $request->file('video')->getClientOriginalName(),
            'path' => $request->file('video')->store('videos', 'videos_disk'),
            'title' => $request->get('title'),
        ]);

        //        dispatch(new ConvertVideoForDownloading($video));
        //        dispatch(new ConvertVideoForStreaming($video));

        //        $downloadUrl = Storage::disk('downloadable_videos')->url($video->id . '.mp4');
        //        $streamUrl = Storage::disk('streamable_videos')->url($video->id . '.m3u8');

        return response()->json([
            'id' => $video->id,
        ], 201);
    }
}
