<?php

namespace App\Http\Controllers;
use App\PaketSoal;
use App\SoalSatuan;
use App\Ujian;
use App\PesertaUjian;
use App\Pilgan;
use App\Essay;
use App\Guru;
// use App\EssayJawab;
// use App\PilganJawab;
use PDF;
use Str;
use Auth;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
  public function exportSoal($id){

    $instansi   = Guru::where('id',auth()->user()->guru->id)->value('instansi');
    $soal_satuan = SoalSatuan::where('paket_soal_id',$id)->orderBy('id','asc')->get();
    $ownuser = PaketSoal::where('id',$id)->value('guru_id');
    if (auth()->user()->guru->id == $ownuser) {
      $soal_pilgan = SoalSatuan::where('jenis','Pilihan Ganda')->where('paket_soal_id',$id)->orderBy('id','asc')->get();
      $soal_essay = SoalSatuan::where('jenis','Essay')->where('paket_soal_id',$id)->orderBy('id','asc')->get();
      $paket_soal = PaketSoal::find($id);
      //$paket_soal_id = $paket_soal->id;


      $pdf = PDF::loadView('Export/soal',compact(['instansi','soal_satuan','paket_soal','soal_pilgan','soal_essay']));
      return $pdf->stream();
    }else {
      return "<center>Tidak dapat mengakses halaman</center>";
      // return view('error',compact(['error']));
    }

  }
}
