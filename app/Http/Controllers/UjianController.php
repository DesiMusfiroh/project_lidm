<?php

namespace App\Http\Controllers;
use App\Kelas;
use App\PaketSoal;
use App\Ujian;
use App\SoalSatuan;
use App\AnggotaKelas;
use App\PesertaUjian;
use App\PilganJawab;
use App\EssayJawab;
use Illuminate\Http\Request;
use Auth;

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
          $data['siswa_id'] = $anggota->siswa_id;
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

    public function monitoring() {
        $ujian_aktif = Ujian::where('guru_id',Auth::user()->guru->id)->where('status',0)->where('isdelete',0)->get();
        $ujian_run = Ujian::where('guru_id',Auth::user()->guru->id)->where('status',1)->where('isdelete',0)->get();
        date_default_timezone_set("Asia/Jakarta");

        // membuat array untuk menyimpan data ujian yang aktif
        $array[] = ['id','paket_soal_id','nama_ujian', 'waktu_mulai','status','start','finish'];
        foreach($ujian_aktif as $key =>$value)
        {
            $start  = date('F d, Y H:i:s', strtotime($value->waktu_mulai));
            $durasi_jam   =  date('H', strtotime($value->paket_soal->durasi));
            $durasi_menit =  date('i', strtotime($value->paket_soal->durasi));
            $durasi_detik =  date('s', strtotime($value->paket_soal->durasi));
            // waktu selesai = waktu mulai + durasi
            $selesai = date_create($value->waktu_mulai);
            date_add($selesai, date_interval_create_from_date_string("$durasi_jam hours, $durasi_menit minutes, $durasi_detik seconds"));
            $finish = date_format($selesai, 'Y-m-d H:i:s');

            $array[++$key] = [
                $value->id,
                $value->paket_soal_id,
                $value->nama_ujian,
                $value->waktu_mulai,
                $value->status,
                $start,
                $finish,
            ];
        }

        // membuat array untuk menyimpan data ujian run
        $run[] = ['id','paket_soal_id','nama_ujian', 'waktu_mulai','status','start','finish'];
        foreach($ujian_run as $key =>$value)
        {
            $start  = date('F d, Y H:i:s', strtotime($value->waktu_mulai));
            $durasi_jam   =  date('H', strtotime($value->paket_soal->durasi));
            $durasi_menit =  date('i', strtotime($value->paket_soal->durasi));
            $durasi_detik =  date('s', strtotime($value->paket_soal->durasi));
            // waktu selesai = waktu mulai + durasi
            $selesai = date_create($value->waktu_mulai);
            date_add($selesai, date_interval_create_from_date_string("$durasi_jam hours, $durasi_menit minutes, $durasi_detik seconds"));
            $finish = date_format($selesai, 'Y-m-d H:i:s');

            $run[++$key] = [
                $value->id,
                $value->paket_soal_id,
                $value->nama_ujian,
                $value->waktu_mulai,
                $value->status,
                $start,
                $finish,
            ];
        }

        return view('Ujian.monitoring',compact('ujian_aktif','ujian_run'))->with('tabel',json_encode($array))->with('run',json_encode($run));
    }


    public function run_exam(Request $request) {

        $update_status_ujian = [
            'status' => 1
        ];
        $posts = Ujian::where('id',$request->ujian_id)->update($update_status_ujian);

        return response()->json($posts);
    }

    public function stop_exam(Request $request) {

        $update_status_ujian = [
            'status' => 2
        ];
        $posts = Ujian::where('id',$request->ujian_id)->update($update_status_ujian);

        return response()->json($posts);
    }

    public function fullscreen_room(Request $request) {
        // $ujian_room = Ujian::find($request->ujian_id);
        $nama_ujian     = Ujian::where('id', $request->ujian_id)->value('nama_ujian');
        $waktu_mulai    = Ujian::where('id', $request->ujian_id)->value('waktu_mulai');
        $paket_soal_id    = Ujian::where('id', $request->ujian_id)->value('paket_soal_id');
        $durasi          = PaketSoal::where('id',$paket_soal_id)->value('durasi');

        date_default_timezone_set("Asia/Jakarta"); // mengatur time zone untuk WIB.
        $durasi_jam   =  date('H', strtotime($durasi));
        $durasi_menit =  date('i', strtotime($durasi));
        $durasi_detik =  date('s', strtotime($durasi));
        // waktu selesai = waktu mulai + durasi
        $selesai = date_create($waktu_mulai);
        date_add($selesai, date_interval_create_from_date_string("$durasi_jam hours, $durasi_menit minutes, $durasi_detik seconds"));
        $waktu_selesai = date_format($selesai, 'Y-m-d H:i:s');

        $peserta    = Peserta::where('ujian_id',$request->ujian_id)->get();
        $array_peserta[] = ['nama_peserta'];
        foreach($peserta as $key =>$value)
        {
            $array_peserta[++$key] = [
                $value->user->name,
            ];
        }

        return response()->json(array(
            'nama_ujian'    => $nama_ujian,
            'waktu_mulai'   => $waktu_mulai,
            'durasi'        => $durasi,
            'waktu_selesai' => $waktu_selesai,
            'array_peserta' => $array_peserta,
        ));
    }

    //Method untuk aktor SISWA -------------------------------------------------------------------------------------
    public function indexUjian(){
        $peserta_ujian = PesertaUjian::where('siswa_id',auth()->user()->siswa->id)->where('status', 0)->get();
        return view('Ujian-Siswa.index',compact(['peserta_ujian']));
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

    public function fetch_data(Request $request){
        $peserta = PesertaUjian::find($request->peserta_ujian_id);
        $ujian = Ujian::where('id',$peserta->ujian_id)->first();
        $paket_soal_id = $ujian->paket_soal_id;
        $paket_soal = PaketSoal::where('id',$paket_soal_id)->get();
        $soal_satuan = SoalSatuan::where('paket_soal_id',$paket_soal_id)->orderBy('id','asc')->paginate(1);
        if($request->ajax())
        {
            return view('Ujian-Siswa.pagination_data', ['soal_satuan' => $soal_satuan, 'ujian' => $ujian, 'peserta' => $peserta ], compact('paket_soal_id'))->render();
        }
    }

    public function storePilgan(Request $request)
    {
        $this->validate($request,[
            'user_id' => 'required',
            'peserta_ujian_id' => 'required',
            'pilgan_id' => 'required',
            'jawab_pilgan' => 'required',
            'score' => 'required',
            'status' => 'required'
        ]);
        $check_jawaban = PilganJawab::where('siswa_id', Auth::user()->siswa->id)
                                    ->where('pilgan_id', $request->pilgan_id)
                                    ->where('peserta_ujian_id', $request->peserta_ujian_id)->first();
        if (!$check_jawaban) {
            $posts = PilganJawab::create([
                'siswa_id' => $request->siswa_id,
                'peserta_ujian_id' => $request->peserta_ujian_id,
                'pilgan_id' => $request->pilgan_id,
                'jawab' => $request->jawab_pilgan,
                'score' => $request->score,
                'status' => $request->status
            ]);

        } elseif ($check_jawaban) {
            $update_pilgan_jawab = [
                'siswa_id' => $request->siswa_id,
                'peserta_ujian_id' => $request->peserta_ujian_id,
                'pilgan_id' => $request->pilgan_id,
                'jawab' => $request->jawab_pilgan,
                'score' => $request->score,
                'status' => $request->status
            ];
            $posts = PilganJawab::where('user_id', Auth::user()->id)
                                ->where('pilgan_id', $request->pilgan_id)
                                ->where('peserta_ujian_id', $request->peserta_ujian_id)->update($update_pilgan_jawab);
        }

        return response()->json($posts);

    }


    public function storeEssay(Request $request)
    {

        $this->validate($request,[
            'siswa_id' => 'required',
            'peserta_ujian_id' => 'required',
            'essay_id' => 'required',
            'jawab_essay' => 'required'
        ]);
        $check_jawaban = EssayJawab::where('siswa_id', Auth::user()->siswa->id)
                                ->where('essay_id', $request->essay_id)
                                ->where('peserta_ujian_id', $request->peserta_ujian_id)->first();
        if (!$check_jawaban) {
            $posts = EssayJawab::create([
                'siswa_id' => $request->siswa_id,
                'peserta_ujian_id' => $request->peserta_ujian_id,
                'essay_id' => $request->essay_id,
                'jawab' => $request->jawab_essay,
            ]);
        } elseif ($check_jawaban) {
            $update_essay_jawab = [
                'siswa_id' => $request->siswa_id,
                'peserta_ujian_id' => $request->peserta_ujian_id,
                'essay_id' => $request->essay_id,
                'jawab' => $request->jawab_essay,
            ];
            $posts = EssayJawab::where('siswa_id', Auth::user()->siswa->id)
                                ->where('essay_id', $request->essay_id)
                                ->where('peserta_ujian_id', $request->peserta_ujian_id)->update($update_essay_jawab);
        }

        return response()->json($posts);
    }


    public function finishUjian($id){
        $peserta = PesertaUjian::find($id);
        $update_finish_peserta = [
            'status' => 1,
        ];
        PesertaUjian::where('id', $id)->update($update_finish_peserta);
        return redirect()->route('home')->with('info','Ujian telah diselesaikan, jawaban anda telah tersimpan !');
    }
}
