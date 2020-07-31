<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnggotaKelompok extends Model
{
    protected $table = 'anggota_kelompok';
    protected $fillable = ['kelompok_id','anggota_kelas_id'];

    public function kelompok(){
    	return $this->belongsTo(Kelompok::class);
    }

    public function anggota_kelas()
    	return $this->belongsTo(AnggotaKelas::class);
    }

}
