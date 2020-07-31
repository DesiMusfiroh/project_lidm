<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pertemuan;
use App\AnggotaKelas;

class Absensi extends Model
{
    protected $table ='absensi';
    protected $fillable = ['pertemuan_id','anggota_kelas_id','status'];
    public function pertemuan() {
        return $this->belongsTo(Pertemuan::class);
    }
    public function anggota_kelas() {
        return $this->belongsTo(AnggotaKelas::class);
    }
}
