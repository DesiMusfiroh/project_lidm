<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Guru;
use App\AnggotaKelas;

class Kelas extends Model
{
    protected $table ='kelas';
    protected $fillable = ['guru_id','nama_kelas','kode_kelas','deskripsi'];
    public function guru() {
        return $this->belongsTo(Guru::class);
    }
    public function anggota_kelas(){
        return $this->hasMany(AnggotaKelas::class,'kelas_id');
    }
}
