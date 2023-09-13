<?php

namespace App\Http\Resources;

use App\Models\Enum\Disk;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => (string) $this->id,
            'title' => (string) $this->title,
            'original_name' => (string) $this->original_name,
            'streamable' => (bool) $this->streamable,
            'stream_strategy' => (string) $this->stream_strategy,
            'stream_link' => Storage::disk(Disk::STREAM_VIDEOS)->url($this->stream_path),
        ];
    }
}
