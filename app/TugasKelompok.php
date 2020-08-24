<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TugasKelompokMaster;
use App\KumpulTugasKelompok;

class TugasKelompok extends Model
{
    protected $table ='tugas_kelompok';
    protected $guarded = [];
    
    public function tugas_kelompok_master()
    {
        return $this->belongsTo(TugasKelompokMaster::class);
    }

    public function kumpul_tugas_kelompok(){
        return $this->hasMany(KumpulTugasKelompok::class,'tugas_kelompok_id');
    }
}
