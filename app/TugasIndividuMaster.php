<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kelas;
use App\TugasIndividu;


class TugasIndividuMaster extends Model
{
    protected $table ='tugas_individu_master';
    protected $fillable = ['kelas_id','jenis','nama_tugas','pertemuan','deadline'];

    public function kelas() {
        return $this->belongsTo(Kelas::class);
    }
    
    public function tugas_individu()
    {
    	return $this->hasMany(TugasIndividu::class,'tugas_individu_master_id');
    }

}
