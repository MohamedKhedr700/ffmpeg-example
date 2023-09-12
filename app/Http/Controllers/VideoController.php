<?php

namespace App\Http\Controllers;

use App\Actions\CreateVideoAction;
use App\Http\Requests\StoreVideoRequest;
use Illuminate\Http\JsonResponse;

class VideoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function __invoke(StoreVideoRequest $request, CreateVideoAction $createVideoAction): JsonResponse
    {
        $video = $createVideoAction->execute($request->file('video'), $request->get('title'));

        //        $downloadUrl = Storage::disk('downloadable_videos')->url($video->id . '.mp4');
        //        $streamUrl = Storage::disk('streamable_videos')->url($video->id . '.m3u8');

        return response()->json([
            'id' => $video->id,
        ], 201);
    }
}
