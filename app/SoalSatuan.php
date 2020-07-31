<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PaketSoal;
use App\Essay;
use App\Pilgan;

class SoalSatuan extends Model
{
    protected $table ='soal_satuan';
    protected $fillable = ['paket_soal_id','poin','jenis'];
    public function paket_soal() {
        return $this->belongsTo(PaketSoal::class);
    }
    public function essay()
    {
    	return $this->hasOne(Essay::class,'soal_satuan_id');
    }

    public function pilgan()
    {
    	return $this->hasOne(Pilgan::class,'soal_satuan_id');
    }
}
