<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pertemuan;
use App\User;

class ChatPertemuan extends Model
{
    protected $table ='chat_pertemuan';
    protected $fillable = ['pertemuan_id','user_id','pesan'];
    public function pertemuan() {
        return $this->belongsTo(Pertemuan::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
