<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class meetings extends Model
{
    use HasFactory;
    protected $casts = [
        'shifts' => 'array'
    ];

    protected $fillable = [
        'meeting_rooms_id', 
        'booker_id',
        'title',
        'description',
        'send_to',
        'start_time',
        'end_time',
        'approved',
        'status',
        'allday'
    ];  

    public function rMeetingRooms(): HasOne
    {
        return $this->hasOne(meeting_rooms::class, 'id', 'meeting_rooms_id');
    }

    public function rBooker(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'booker_id');
    }
}
