<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kelas;
use App\TugasKelompok;


class TugasKelompokMaster extends Model
{
    protected $table ='tugas_kelompok_master';
    protected $guarded = [];
    public function kelas() {
        return $this->belongsTo(Kelas::class);
    }
    public function tugas_kelompok()
    {
    	return $this->hasMany(TugasKelompok::class,'tugas_kelompok_master_id');
    }

}
