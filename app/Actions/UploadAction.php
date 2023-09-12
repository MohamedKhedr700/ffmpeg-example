<?php

namespace App\Actions;

use FFMpeg\Format\Video\X264;
use Illuminate\Http\UploadedFile;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class UploadAction
{
    /**
     * Execute the action.
     */
    public function execute(UploadedFile $file)
    {
        $file->storeAs('videos', $file->getClientOriginalName());

        $this->convertToHls($file);
    }

    /**
     * Convert the video to HLS.
     */
    private function convertToHls(UploadedFile $file)
    {
        $lowBitrate = (new X264)->setKiloBitrate(250);
        $midBitrate = (new X264)->setKiloBitrate(500);
        $highBitrate = (new X264)->setKiloBitrate(1000);

        FFMpeg::open('videos/'.$file->getClientOriginalName())
            ->exportForHLS()
            ->setSegmentLength(10) // optional
            ->setKeyFrameInterval(48) // optional
            ->addFormat($lowBitrate)
//            ->addFormazt($midBitrate)
//            ->addFormat($highBitrate)
            ->save('videos/'.$file->getClientOriginalName().'.m3u8');
    }
}
