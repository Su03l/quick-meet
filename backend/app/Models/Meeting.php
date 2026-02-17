<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Meeting extends Model
{
    use HasUuids;

    protected $fillable = [
        'title',
        'description',
        'duration_minutes',
        'max_participants',
        'status',
        'user_id',
        'started_at'
    ];

    protected $appends = ['remaining_seconds'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agendaItems()
    {
        return $this->hasMany(AgendaItem::class);
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function getRemainingSecondsAttribute()
    {
        if ($this->status !== 'live' || !$this->started_at) {
            return $this->duration_minutes * 60;
        }

        $startedAt = Carbon::parse($this->started_at);
        $elapsed = now()->diffInSeconds($startedAt);
        $total = $this->duration_minutes * 60;

        return max(0, $total - $elapsed);
    }
}
