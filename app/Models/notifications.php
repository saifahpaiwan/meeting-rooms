<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class notifications extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender_id', 
        'recipient_id',
        'type_id',
        'url',
        'message', 
        'status',
    ];

    public function sender_r(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'sender_id');
    } 

    public function recipient_r(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'recipient_id');
    } 

    public function notiType_r(): HasOne
    {
        return $this->hasOne(type_notifications::class, 'id', 'type_id');
    } 
}
