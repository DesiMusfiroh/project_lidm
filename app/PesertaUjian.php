<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesertaUjian extends Model
{
    protected $table = 'peserta_ujian';

    protected $fillable = ['ujian_id','anggota_kelas_id','siswa_id','nilai','status','isdelete'];

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

    public function siswa(){
      return $this->belongsTo(Siswa::class);
    }
    public function total_nilai(){
      $id_peserta_ujian = $this->id;
      $total_poin = SoalSatuan::where('paket_soal_id',$this->ujian->paket_soal->id)->sum('poin');
      $score_pilgan = PilganJawab::where('peserta_ujian_id',$id_peserta_ujian)->sum('score');
      $score_essay = EssayJawab::where('peserta_ujian_id',$id_peserta_ujian)->where('score','!=',null)->sum('score');
      $poin_didapat = $score_pilgan + $score_essay;
      $nilai_akhir = $poin_didapat / $total_poin * 100;
      $nilai_akhir = substr($nilai_akhir, 0, 5);
      return $nilai_akhir;
    }
}
