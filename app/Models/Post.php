<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\DatabaseNotification;

class post extends Model
{
    use HasFactory, SoftDeletes, Notifiable;
    
    protected $fillable = [
        'name',
        'age',
        'salary',
        'image',
        'Status',
        'Gender', // Add the Status attribute to the fillable array
    ];
    public function getRouteKeyName()
    {
        return 'id';
    }
    public function user1()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function user2()
    {
        return $this->belongsTo(User::class, 'user_id2');
    }
    public function user3()
    {
        return $this->belongsTo(User::class, 'user_id3');
    }
    public function notifications()
    {
        return $this->morphMany(DatabaseNotification::class, 'notifiable')
                    ->orderBy('created_at', 'desc');
    } 
}
