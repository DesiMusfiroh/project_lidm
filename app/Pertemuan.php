<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kelas;

class Pertemuan extends Model
{
    protected $table ='pertemuan';
    protected $fillable = ['kelas_id','nama_pertemuan','deskripsi','waktu_mulai','status'];
    public function kelas() {
        return $this->belongsTo(Kelas::class);
    }
}
