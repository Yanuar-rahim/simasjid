<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * Mass Assignable
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'foto',
        'role',
        'email_verified_at',
        'password',
        'last_login_at',
        'last_seen',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
    ];

    /**
     * Hidden
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_seen' => 'datetime',
            'last_login_at' => 'datetime',
            'two_factor_confirmed_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /*
|--------------------------------------------------------------------------
| Keuangan
|--------------------------------------------------------------------------
*/
    public function pemasukan()
    {
        return $this->hasMany(Pemasukan::class);
    }

    public function pengeluaran()
    {
        return $this->hasMany(Pengeluaran::class);
    }

    public function logs()
    {
        return $this->hasMany(UserLog::class)
            ->latest();
    }

    public function getOnlineStatusAttribute()
    {
        if (!$this->last_seen) {
            return 'offline';
        }

        $menit = now()->diffInMinutes($this->last_seen);

        if ($menit < 2) {
            return 'online';
        }

        if ($menit < 10) {
            return 'recent';
        }

        return 'offline';
    }
}
