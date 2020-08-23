<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TugasIndividuMaster;

class TugasIndividu extends Model
{
    protected $table ='tugas_individu';
    protected $fillable = ['tugas_individu_master_id','anggota_kelas_id','tugas','status','nilai'];

    public function tugas_individu_master()
    {
        return $this->belongsTo(TugasIndividuMaster::class);
    }
}
