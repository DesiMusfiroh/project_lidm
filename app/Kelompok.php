<?php

namespace App;
use App\KelompokMaster;
use Illuminate\Database\Eloquent\Model;

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
}
