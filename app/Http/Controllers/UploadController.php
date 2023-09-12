<?php

namespace App\Http\Controllers;

use App\Actions\UploadAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UploadController
{
    /**
     * Invoke the controller.
     */
    public function __invoke(Request $request, UploadAction $uploadAction): JsonResponse
    {
        $uploadAction->execute($request->file('video'));

        return response()->json([
            'message' => 'successfully uploaded',
        ]);
    }
}
