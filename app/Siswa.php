<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Siswa extends Model
{
    protected $table ='siswa';
    protected $fillable = ['user_id','nomor_induk','nama_lengkap','alamat','jk','instansi','angkatan','no_hp','foto'];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
