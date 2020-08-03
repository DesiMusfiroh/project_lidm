<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SoalSatuan;

class Essay extends Model
{
    protected $table ='essay';
    protected $fillable = ['soal_satuan_id','pertanyaan','jawaban'];
    
    public function soal_satuan() {
        return $this->belongsTo(SoalSatuan::class);
    }

    public function essay_jawab(){
        return $this->hasMany(EssayJawab::class,'essay_id');
    }  
}
