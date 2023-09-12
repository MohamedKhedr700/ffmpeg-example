<?php

namespace App\Http\Controllers;

use App\Actions\StreamAction;
use App\Actions\UploadAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class StreamController
{
    /**
     * Invoke the controller.
     */
    public function __invoke(string $video, StreamAction $streamAction): BinaryFileResponse
    {
        return $streamAction->execute($video);
        $videoPath = $streamAction->execute($video);

        return response()->file($videoPath, [
            'Content-Type' => 'application/x-mpegURL',
            'isHls' => true,
        ]);
    }
}
