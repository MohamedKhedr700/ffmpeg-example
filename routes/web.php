<?php

use App\Models\Enum\Disk;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// welcome page
Route::get('/', function () {
    return view('welcome');
});

// stream hls playlist
Route::get('videos/stream/{playlist}', function ($playlist) {
    return FFMpeg::dynamicHLSPlaylist(Disk::STREAM_VIDEOS)
        ->fromDisk(Disk::STREAM_VIDEOS)
        ->open($playlist)
        ->setKeyUrlResolver(function (string $key) {
            return route('video.key', ['key' => $key]);
        })
        ->setPlaylistUrlResolver(function (string $playlist) {
            return route('video.stream', ['playlist' => $playlist]);
        })
        ->setMediaUrlResolver(function (string $media) {
            return Storage::disk(Disk::STREAM_VIDEOS)->url($media);
        });
})->name('video.stream');

// download hls keys
Route::get('videos/stream/key/{key}', function ($key) {
    return Storage::disk(Disk::STREAM_VIDEOS)->download($key);
})->name('video.key');
