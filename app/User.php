<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Guru;
use App\Siswa;
use App\ChatPertemuan;

class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'name', 'email', 'password','role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function guru() {
    	return $this->hasOne(Guru::class,'user_id');
    }
    public function siswa() {
    	return $this->hasOne(Siswa::class,'user_id');
    }
    public function chat_pertemuan(){
        return $this->hasMany(ChatPertemuan::class,'user_id');
    }
}
