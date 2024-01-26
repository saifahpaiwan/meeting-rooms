<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class type_notifications extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name', 
        'color',
        'icon',
        'status'
    ]; 
 
}
