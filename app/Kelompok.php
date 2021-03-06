<?php

namespace App;
use App\KelompokMaster;
use Illuminate\Database\Eloquent\Model;
use App\ChatKelompok;

class Kelompok extends Model
{
    protected $table = 'kelompok';
    protected $fillable = ['kelompok_master_id','nama_kelompok'];

    public function kelompok_master(){
    	return $this->belongsTo(KelompokMaster::class);
    }

    public function anggota_kelompok(){
    	return $this->hasMany(AnggotaKelompok::class,'kelompok_id');
    }
    public function kumpul_tugas_kelompok() {
        return $this->hasMany(KumpulTugasKelompok::class,'kelompok_id');
    }
    public function chat_kelompok(){
        return $this->hasMany(ChatKelompok::class,'kelompok_id');
    }
}

