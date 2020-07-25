<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Guru;
use App\Siswa;

class User extends Authenticatable
{
    use Notifiable;
    public function guru() {
    	return $this->hasOne(Guru::class,'user_id');
    }
    protected $fillable = [
        'name', 'email', 'password','role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
