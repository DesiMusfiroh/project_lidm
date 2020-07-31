<?php

namespace App;
use App\Kelompok;
use Illuminate\Database\Eloquent\Model;

class KelompokMaster extends Model
{
    protected $table = 'kelompok_master';
    protected $fillable = ['kelas_id','deskripsi','jumlah_kelompok','status'];

    public function kelas(){
    	return $this->belongsTo(Kelas::class);
    }

    // public function kelompok()
    //   return $this->hasMany(Kelompok::class,'kelompok_master_id');
    // }
}
