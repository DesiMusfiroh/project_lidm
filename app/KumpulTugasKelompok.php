<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TugasKelompok;
use App\Kelompok;

class KumpulTugasKelompok extends Model
{
    protected $table = 'kumpul_tugas_kelompok';
    protected $guarded = [];

    public function tugas_kelompok(){
        return $this->belongsTo(TugasKelompok::class);
    }

    public function kelompok(){
        return $this->belongsTo(Kelompok::class);
    }
}
