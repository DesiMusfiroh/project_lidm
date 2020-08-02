<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Guru;
use App\Ujian;
use App\SoalSatuan;

class PaketSoal extends Model
{
    protected $table ='paket_soal';
    protected $fillable = ['guru_id','judul','durasi','isdelete'];
    
    public function guru(){
        return $this->belongsTo(Guru::class);
    }
    public function soal_satuan()
    {
    	return $this->hasMany(SoalSatuan::class,'paket_soal_id');
    }

    public function ujian(){
      return $this->hasMany(Ujian::class,'paket_soal_id');
    }

    public function jumlah_soal(){
      $id_paket_soal = $this->id;
      $jumlahSoal = SoalSatuan::where('paket_soal_id',$id_paket_soal)->count();
      return $jumlahSoal;
    }
}
