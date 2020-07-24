<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Guru extends Model
{
    protected $table ='guru';
    protected $fillable = ['user_id','nip','nama_lengkap','alamat','jk','instansi','no_hp','foto'];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
