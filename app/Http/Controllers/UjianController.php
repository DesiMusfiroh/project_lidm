<?php

namespace App\Http\Controllers;
use App\Kelas;
use App\PaketSoal;
use App\Ujian;
use App\SoalSatuan;
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



    //Method untuk aktor SISWA -------------------------------------------------------------------------------------
    public function indexUjian(){
        // $id = auth()->user()->siswa->anggota_kelas()->first()->id;
        // dd($id);
        //($id);
        // $id = auth()->user()->siswa->with('anggota_kelas:id')->get();
        // dd($id);

        // $current_user = PesertaUjian::where('anggota_kelas_id',auth()->user()->siswa->anggota_kelas->id)->get();
        // $current_user = PesertaUjian::where('anggota_kelas_id',auth()->user()->siswa->id)->with('anggota_kelas:auth')->get();
        // $current_user = PesertaUjian::where('anggota_kelas_id',$id->anggota_kelas()->id)->get();

        //dd($current_user);
        //$anggota_kelas_id = $current_user->siswa->anggota_kelas->id->get();
        //dd($anggota_kelas_id);
        $id = auth()->user()->siswa->anggota_kelas()->value('id');
        //dd($id);
        //dd($id);
        $peserta = PesertaUjian::where('anggota_kelas_id',$id)->get();
        //dd($ujian_yg_saya_ikuti);

        return view('Ujian-Siswa.index',compact(['peserta']));
    }

    public function waitUjian($id)
    {
        $peserta = PesertaUjian::find($id);
        $ujian = Ujian::where('id',$peserta->ujian_id)->first();
        $paket_soal_id = $ujian->paket_soal_id;
        $paket_soal = PaketSoal::where('id',$paket_soal_id)->get();
        $soal_satuan = SoalSatuan::where('paket_soal_id',$paket_soal_id)->orderBy('id','asc')->paginate(1);

        date_default_timezone_set("Asia/Jakarta"); // mengatur time zone untuk WIB.
        $waktu_mulai = date('F d, Y H:i:s', strtotime($ujian->waktu_mulai)); // mengubah bentuk string waktu mulai untuk digunakan pada date di js

        $durasi_jam   =  date('H', strtotime($ujian->paket_soal->durasi));
        $durasi_menit =  date('i', strtotime($ujian->paket_soal->durasi));
        $durasi_detik =  date('s', strtotime($ujian->paket_soal->durasi));

        // waktu selesai = waktu mulai + durasi
        $selesai = date_create($ujian->waktu_mulai);
        date_add($selesai, date_interval_create_from_date_string("$durasi_jam hours, $durasi_menit minutes, $durasi_detik seconds"));
        $waktu_selesai = date_format($selesai, 'Y-m-d H:i:s');

        return view('Ujian-siswa.wait',['soal_satuan' => $soal_satuan, 'ujian' => $ujian, 'peserta' => $peserta ], compact('paket_soal_id','waktu_mulai','waktu_selesai'));
    }
}
