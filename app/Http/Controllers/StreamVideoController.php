<?php

namespace App\Http\Controllers;

use App\Actions\Video\FindVideoAction;
use App\Actions\Video\StreamVideoAction;
use App\Http\Resources\VideoResource;
use Illuminate\Http\JsonResponse;

class StreamVideoController extends Controller
{
    /**
     * show a resource in storage.
     */
    public function __invoke(string $id, StreamVideoAction $streamVideoAction): JsonResponse
    {
        $video = $streamVideoAction->execute($id);

        return response()->json([
            'data' => VideoResource::make($video),
        ]);
    }
}
