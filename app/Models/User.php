<?php
  
namespace App\Models;
  
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
  
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    protected $fillable = [
        'id',  
        'plant_id', 
        'username', 
        'password',
        'email', 
        'email_verified_at',
        'phone', 
        'images_name',
        'receive_notifications_email',
        'receive_notifications_system',
        'empolyee_code',
        'status', 
    ]; 
 
    protected $hidden = [ 
        'remember_token',
    ];
   
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
 
}