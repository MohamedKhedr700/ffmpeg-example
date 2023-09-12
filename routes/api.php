<?php

use App\Http\Controllers\CreateVideoController;
use App\Http\Controllers\ShowVideoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'video',
], function () {
    // upload video
    Route::post('/', CreateVideoController::class);
    // get video
    Route::get('{id}', ShowVideoController::class);
}
);
