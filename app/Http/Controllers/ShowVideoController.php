<?php

namespace App\Http\Controllers;

use App\Actions\Video\ShowVideoAction;
use App\Http\Resources\VideoResource;
use Illuminate\Http\JsonResponse;

class ShowVideoController extends Controller
{
    /**
     * show a resource in storage.
     */
    public function __invoke(string $id, ShowVideoAction $showVideoAction): JsonResponse
    {
        $video = $showVideoAction->execute($id);

        return response()->json([
            'data' => VideoResource::make($video),
        ]);
    }
}
