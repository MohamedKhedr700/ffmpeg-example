<?php

namespace App\Actions;

use App\Jobs\ConvertVideoForStreaming;

class ConvertForStreamAction
{
    /**
     * Execute the action.
     */
    public function execute($video)
    {
        ConvertVideoForStreaming::dispatch($video);
    }
}
