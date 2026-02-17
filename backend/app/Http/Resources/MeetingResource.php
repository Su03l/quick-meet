<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MeetingResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'duration_minutes' => $this->duration_minutes,
            'remaining_seconds' => $this->remaining_seconds,
            'max_participants' => $this->max_participants,
            'started_at' => $this->started_at,
            'agenda' => AgendaItemResource::collection($this->whenLoaded('agendaItems')),
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
