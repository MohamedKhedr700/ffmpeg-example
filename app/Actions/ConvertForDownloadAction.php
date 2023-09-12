<?php

namespace App\Actions;

use App\Jobs\ConvertVideoForDownloading;

class ConvertForDownloadAction
{
    /**
     * Execute the action.
     */
    public function execute($video)
    {
        ConvertVideoForDownloading::dispatch($video);
    }
}
