<?php

namespace App\Http\Controllers;

use App\Actions\Video\CreateVideoAction;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Resources\VideoResource;
use Illuminate\Http\JsonResponse;

class CreateVideoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function __invoke(StoreVideoRequest $request, CreateVideoAction $createVideoAction): JsonResponse
    {
        $video = $createVideoAction->execute($request->file('video'), $request->get('title'));

        //        $downloadUrl = Storage::disk('downloadable_videos')->url($video->id . '.mp4');
        //        $streamUrl = Storage::disk('streamable_videos')->url($video->id . '.m3u8');

        return response()->json(VideoResource::make($video), 201);
    }
}
