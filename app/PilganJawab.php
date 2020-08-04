<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Siswa;
use App\Pilgan;
use App\PesertaUjian;
use App\Pilgan;

class PilganJawab extends Model
{
    protected $table ='pilgan_jawab';
    protected $fillable = ['siswa_id','pilgan_id','peserta_ujian_id','jawab','score','status'];
    public function siswa() {
        return $this->belongsTo(Siswa::class);
    }
    public function peserta_ujian(){
        return $this->belongsTo(PesertaUjian::class);
    }
    public function pilgan(){
        return $this->belongsTo(Pilgan::class);
    }

}
