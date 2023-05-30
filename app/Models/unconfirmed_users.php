<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class unconfirmed_users extends Model
{
    use HasFactory;

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

    public function userNotifications()
    {
        return $this->morphMany(DatabaseNotification::class, 'notifiable')
                    ->orderBy('created_at', 'desc');
    } 
}
