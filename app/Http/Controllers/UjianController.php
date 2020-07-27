<?php

namespace App\Http\Controllers;
use App\Kelas;
use App\PaketSoal;
use App\Ujian;
use App\AnggotaKelas;
use App\PesertaUjian;
use Illuminate\Http\Request;

class UjianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
      $ujian = Ujian::where('guru_id',auth()->user()->guru->id)->get();
      //dd($ujian);
      return view('Ujian.index',compact(['ujian']));
    }

    public function create(){
      $kelas = Kelas::where('guru_id',auth()->user()->guru->id)->get();
      $paketsoal = PaketSoal::where('guru_id',auth()->user()->guru->id)->get();

      return view('Ujian.create',compact(['kelas','paketsoal']));
    }

    public function store(Request $request){
        $anggota_kelas = AnggotaKelas::where('kelas_id',$request->kelas)->get();
        $ujian = new Ujian;
        $ujian->kelas_id = $request->kelas;
        $ujian->guru_id = auth()->user()->guru->id;
        $ujian->nama_ujian = $request->nama_ujian;
        $ujian->paket_soal_id = $request->paketsoal;
        $ujian->waktu_mulai = $request->waktu_mulai;
        $ujian->isdelete = false;
        $ujian->status = 0;
        $ujian->save();


        foreach ($anggota_kelas as $e => $anggota) {
          $data['ujian_id'] = $ujian->id;
          $data['anggota_kelas_id'] = $anggota->id;
          $data['nilai'] = 0;
          $data['status'] = false;

          PesertaUjian::create($data);
        }

        return redirect()->route('guru.ujian.index')->with('success','Berhasil membuat ujian');
    }

    public function show($id){
      $ujian = Ujian::find($id);
      
      return view('Ujian.show',compact(['ujian']));
    }
}
