<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SoalSatuan;

class Pilgan extends Model
{
    protected $table ='pilgan';
    protected $fillable = ['soal_satuan_id','pertanyaan','pil_a','pil_b','pil_c','pil_d','pil_e','kunci'];
    public function soal_satuan() {
        return $this->belongsTo(SoalSatuan::class);
    }
}
