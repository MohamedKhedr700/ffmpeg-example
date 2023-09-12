<?php

namespace App\Jobs;

use App\Models\Enum\Disk;
use App\Models\Video;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class ConvertVideoForDownloading implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The video model instance.
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
        $downloadPath = $this->video->id.'.mp4';

        // create a video format...
        $lowBitrateFormat = (new X264)->setKiloBitrate(500);

        // open the uploaded video from the right disk...
        FFMpeg::fromDisk($this->video->disk)
            ->open($this->video->path)

            // add the 'resize' filter...
            ->addFilter(function ($filters) {
                $filters->resize(new Dimension(960, 540));
            })

            // call the 'export' method...
            ->export()

            // tell the MediaExporter to which disk and in which format we want to export...
            ->toDisk(Disk::DOWNLOAD_VIDEOS)
            ->inFormat($lowBitrateFormat)

            // call the 'save' method with a filename...
            ->save($downloadPath);

        // update the database so we know the convertion is done!
        $this->video->update([
            'download_disk' => Disk::DOWNLOAD_VIDEOS,
            'download_path' => $downloadPath,
            'downloadable_at' => Carbon::now(),
            'downloadable' => true,
        ]);
    }
}
