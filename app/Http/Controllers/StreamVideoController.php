<?php

namespace App\Http\Controllers;

use App\Actions\Video\StreamVideoAction;

class StreamVideoController extends Controller
{
    /**
     * show a resource in storage.
     */
    public function __invoke(string $id, StreamVideoAction $streamVideoAction)
    {
        $streamUrl = $streamVideoAction->execute($id);

        return redirect($streamUrl);

//        return response()->json([
//            'data' => [
//                'stream_url' => $streamUrl,
//            ],
//        ]);
    }
}
