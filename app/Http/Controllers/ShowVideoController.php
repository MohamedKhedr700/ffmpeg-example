<?php

namespace App\Http\Controllers;

use App\Actions\Video\FindVideoAction;
use App\Http\Resources\VideoResource;
use Illuminate\Http\JsonResponse;

class ShowVideoController extends Controller
{
    /**
     * show a resource in storage.
     */
    public function __invoke(string $id, FindVideoAction $findVideoAction): JsonResponse
    {
        $video = $findVideoAction->execute($id);

        return response()->json([
            'data' => VideoResource::make($video),
        ]);
    }
}
