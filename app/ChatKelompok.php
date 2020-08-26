<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kelompok;
use App\User;

class ChatKelompok extends Model
{
    protected $table ='chat_kelompok';
    protected $fillable = ['kelompok_id','user_id','pesan'];
    public function kelompok() {
        return $this->belongsTo(Kelompok::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
