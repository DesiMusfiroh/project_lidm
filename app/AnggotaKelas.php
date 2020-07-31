<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kelas;
use App\Siswa;
use App\Absensi;
use App\AnggotaKelompok;

class AnggotaKelas extends Model
{
    protected $table ='anggota_kelas';
    protected $fillable = ['kelas_id','siswa_id'];
    public function kelas() {
        return $this->belongsTo(Kelas::class);
    }
    public function siswa() {
        return $this->belongsTo(Siswa::class);
    }
    public function peserta_ujian(){
      return $this->hasMany(PesertaUjian::class,'anggota_kelas_id');
    }
    public function absensi(){
        return $this->hasMany(Absensi::class,'anggota_kelas_id');
    }
    public function anggota_kelompok(){
        return $this->hasMany(AnggotaKelompok::class,'anggota_kelas_id');
    }
}
