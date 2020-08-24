<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TugasIndividuMaster;
use App\KumpulTugasIndividu;
class TugasIndividu extends Model
{
    protected $table ='tugas_individu';
    protected $fillable = ['tugas_individu_master_id','status'];

    public function tugas_individu_master()
    {
        return $this->belongsTo(TugasIndividuMaster::class);
    }

    public function kumpul_tugas_individu(){
        return $this->hasMany(KumpulTugasIndividu::class,'tugas_individu_id');
    }

}
