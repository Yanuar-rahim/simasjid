<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $fillable = [
        'user_id',
        'activity',
        'ip_address',
        'device',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}