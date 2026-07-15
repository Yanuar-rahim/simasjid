<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
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
        'password',
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
            'last_login_at' => 'datetime',
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
}
