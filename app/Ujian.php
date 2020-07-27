<?php

namespace App;
use App\Kelas;
use App\PaketSoal;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    protected $table = 'ujian';
    protected $fillable = ['kelas_id','paket_soal_id','nama_ujian','waktu_mulai','status','isdelete'];

    public function kelas(){
      return $this->belongsTo(Kelas::class);
    }

    public function paketsoal(){
      return $this->belongsTo(PaketSoal::class);
    }
}
