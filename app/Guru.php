<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Kelas;
use App\PaketSoal;

class Guru extends Model
{
    protected $table ='guru';
    protected $fillable = ['user_id','nip','nama_lengkap','alamat','jk','instansi','no_hp','foto'];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function kelas(){
        return $this->hasMany(Kelas::class,'guru_id');
    }
    public function paket_soal(){
        return $this->hasMany(PaketSoal::class,'guru_id');
    }

    public function ujian(){
      return $this->hasMany(Ujian::class,'guru_id');
    }
    public function jumlah_kelas(){
        $guru_id  = $this->id;
        $jumlah_kelas = Kelas::where('guru_id',$guru_id)->count();
        return $jumlah_kelas;
    }
    public function jumlah_ujian(){
        $guru_id  = $this->id;
        $jumlah_ujian = Ujian::where('guru_id',$guru_id)->where('isdelete',0)->count();
        return $jumlah_ujian;
    }

    //Masih salah jumlah siswa
    public function jumlah_siswa(){
        $guru_id  = $this->id;
        $jumlah_siswa =Kelas::where('guru_id',$guru_id)->count();
        return $jumlah_siswa;
    }
}
