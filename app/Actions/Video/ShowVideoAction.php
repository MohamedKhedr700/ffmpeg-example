<?php

namespace App\Actions\Video;

use App\Models\Video;

class ShowVideoAction extends VideoAction
{
    /**
     * Execute the action.
     */
    public function execute(string $id): ?Video
    {
        return $this->video()->find($id);
    }
}
