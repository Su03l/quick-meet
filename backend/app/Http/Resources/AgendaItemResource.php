<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgendaItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'topic' => $this->topic,
            'speaker_name' => $this->speaker_name,
            'allocated_minutes' => $this->allocated_minutes,
            'is_completed' => (bool) $this->is_completed,
        ];
    }
}
