<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use App\User;
// use App\EssayJawab;
// use App\PilganJawab;
// use App\AnggotaKelas;
// use App\PesertaUjian;
class Siswa extends Model
{
    protected $table ='siswa';
    protected $fillable = ['user_id','nomor_induk','nama_lengkap','alamat','jk','instansi','angkatan','no_hp','foto'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function anggota_kelas(){
        return $this->hasMany(AnggotaKelas::class,'siswa_id');
    }

    public function essay_jawab(){
      return $this->hasMany(EssayJawab::class,'siswa_id');
    }

    public function pilgan_jawab(){
      return $this->hasMany(PilganJawab::class,'siswa_id');
    }

    public function peserta_ujian()
    {
        return $this->hasMany(PesertaUjian::class, 'siswa_id');
    }
}
