<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\PesertaUjian;
use App\Siswa;
use App\Essay;

class EssayJawab extends Model
{
    protected $table ='essay_jawab';
    protected $fillable = ['siswa_id','essay_id','peserta_ujian_id','jawab'];
    public function siswa() {
        return $this->belongsTo(Siswa::class);
    }
    public function peserta(){
        return $this->belongsTo(PesertaUjian::class);
    }
    public function essay(){
        return $this->belongsTo(Essay::class);
    }
}
