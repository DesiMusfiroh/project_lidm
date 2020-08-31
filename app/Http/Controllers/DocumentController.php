<?php

namespace App\Http\Controllers;
use App\PaketSoal;
use App\SoalSatuan;
use App\Ujian;
use App\PesertaUjian;
use App\Pilgan;
use App\Essay;
use App\Siswa;
use App\Guru;
use App\EssayJawab;
use App\PilganJawab;
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
  public function exportKunci($id){

        $soal_satuan = SoalSatuan::where('paket_soal_id',$id)->orderBy('id','asc')->get();
        $ownuser = PaketSoal::where('id',$id)->value('guru_id');
        if (auth()->user()->id == $ownuser) {

          $soal_pilgan = SoalSatuan::where('jenis','Pilihan Ganda')->where('paket_soal_id',$id)->orderBy('id','asc')->get();
          $soal_essay = SoalSatuan::where('jenis','Essay')->where('paket_soal_id',$id)->orderBy('id','asc')->get();

          $paket_soal = PaketSoal::find($id);

          $pdf = PDF::loadView('Export/Kunci',compact(['soal_satuan','paket_soal','soal_pilgan','soal_essay',]));
          return $pdf->stream();
        }else {
          $error = "Tidak dapat mengakses halaman";
          return view('error',compact(['error']));
        }

  }

  public function exportHasil($id){ 
        $peserta_ujian  = PesertaUjian::find($id);

        $nama_lengkap   = Siswa::where('id',$peserta_ujian->siswa_id)->value('nama_lengkap');
        $instansi       = Siswa::where('id',$peserta_ujian->siswa_id)->value('instansi');
        $no_hp          = Siswa::where('id',$peserta_ujian->siswa_id)->value('no_hp');
        $essay_jawab    = EssayJawab::where('peserta_ujian_id', $peserta_ujian->id)->where('score','!=',null)->get();
        $pilgan_jawab   = PilganJawab::where('peserta_ujian_id', $peserta_ujian->id)->get();

        $total_poin     = SoalSatuan::where('paket_soal_id',$peserta_ujian->ujian->paket_soal->id)->sum('poin');
        $score_pilgan   = PilganJawab::where('peserta_ujian_id',$peserta_ujian->id)->sum('score');
        $score_essay    = EssayJawab::where('peserta_ujian_id',$peserta_ujian->id)->sum('score');
        $total_score    = $score_essay + $score_pilgan;
        $nilai_akhir    = $total_score / $total_poin * 100;
        $pdf = PDF::loadView('Export/Hasil',compact('peserta_ujian','nama_lengkap','essay_jawab','pilgan_jawab','instansi','no_hp','nilai_akhir'));
        return $pdf->stream();
    }
    public function exportRekap($id){
 
      $ujian          = Ujian::find($id);
      $peserta_ujian  = PesertaUjian::where('ujian_id',$id)->get();
      //dd($peserta_ujian);
      // $siswa          = Siswa::where('peserta_ujian_id',$peserta_ujian->siswa->id);
      $pdf            = PDF::loadView('Export/Rekap',compact('ujian','peserta_ujian'));
    
      return $pdf->stream();
  }

  
}
