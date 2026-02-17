<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendaItem extends Model
{
    protected $fillable = [
        'meeting_id',
        'topic',
        'speaker_name',
        'allocated_minutes',
        'is_completed'
    ];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}
