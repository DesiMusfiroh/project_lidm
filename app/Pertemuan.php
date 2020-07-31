<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kelas;
use App\Absensi;
use App\ChatPertemuan;

class Pertemuan extends Model
{
    protected $table ='pertemuan';
    protected $fillable = ['kelas_id','nama_pertemuan','deskripsi','waktu_mulai','status'];
    public function kelas() {
        return $this->belongsTo(Kelas::class);
    }
    public function absensi(){
        return $this->hasMany(Absensi::class,'pertemuan_id');
    }
    public function chat_pertemuan(){
        return $this->hasMany(ChatPertemuan::class,'pertemuan_id');
    }
}
