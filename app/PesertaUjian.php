<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesertaUjian extends Model
{
    protected $table = 'peserta_ujian';

    protected $fillable = ['ujian_id','anggota_kelas_id','nilai','status'];

    public function ujian(){
      return $this->belongsTo(Ujian::class);
    }

    public function anggota_kelas(){
      return $this->belongsTo(AnggotaKelas::class);
    }

    public function essay_jawab(){
      return $this->hasMany(EssayJawab::class,'peserta_ujian_id');
    }
    public function pilgan_jawab(){
      return $this->hasMany(PilganJawab::class,'peserta_ujian_id');
    }
}
