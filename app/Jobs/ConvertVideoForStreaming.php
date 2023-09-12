<?php

namespace App\Jobs;

use App\Models\Video;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class ConvertVideoForStreaming implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The video instance.
     */
    public Video $video;

    /**
     * Create a new job instance.
     */
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $streamDisk = 'stream_videos';

        $streamPath = $this->video->id.'.m3u8';


        // create some video formats...
        $lowBitrateFormat = (new X264)->setKiloBitrate(500);
        //        $midBitrateFormat = (new X264)->setKiloBitrate(1500);
        //        $highBitrateFormat = (new X264)->setKiloBitrate(3000);

        // open the uploaded video from the right disk...
        FFMpeg::fromDisk($this->video->disk)
            ->open($this->video->path)

            // call the 'exportForHLS' method and specify the disk to which we want to export...
            ->exportForHLS()
            ->toDisk($streamDisk)

            // we'll add different formats so the stream will play smoothly
            // with all kinds of internet connections...
            ->addFormat($lowBitrateFormat)
//            ->addFormat($midBitrateFormat)
//            ->addFormat($highBitrateFormat)

            // call the 'save' method with a filename...
            ->save($streamPath);

        // update the database so we know the convertion is done!
        $this->video->update([
            'stream_disk' => $streamDisk,
            'stream_path' => $streamPath,
            'streamable_at' => Carbon::now(),
            'stream_strategy' => 'hls',
            'streamable' => true,
        ]);
    }
}
