<?php

namespace App;
use App\TugasIndividu;
use App\AnggotaKelas;
use Illuminate\Database\Eloquent\Model;

class KumpulTugasIndividu extends Model
{
    protected $table = 'kumpul_tugas_individu';
    protected $guarded = [];

    public function tugas_individu(){
        return $this->belongsTo(TugasIndividu::class);
    }

    public function anggota_kelas(){
        return $this->belongsTo(AnggotaKelas::class);
    }

    
}
