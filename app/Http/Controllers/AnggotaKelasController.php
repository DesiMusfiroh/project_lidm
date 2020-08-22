<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;
use App\Siswa;
use App\AnggotaKelas;
use App\Pertemuan;
use App\KelompokMaster;
use App\Kelompok;
use App\Absensi;
use App\AnggotaKelompok;
use App\User;
use App\ChatPertemuan;
use App\PesertaUjian;
use App\EssayJawab;
use App\PilganJawab;
use App\SoalSatuan;

use Auth;

class AnggotaKelasController extends Controller
{

    public function index()
    {
        try {
          $anggotaKelas = AnggotaKelas::where('siswa_id',Auth::user()->siswa->id)->get();
          return view('AnggotaKelas.index',['anggotaKelas' => $anggotaKelas]);
        } catch (\Exception $e) {
          return redirect()->route('siswa.profil')->with('pesan','Mohon lengkapi profil anda');
        }

    }

    public function gabungKelas(Request $request)
    {
        // try {
        if (Kelas::where('kode_kelas',$request->kode_kelas)) {
            $anggotaKelas = new AnggotaKelas;
            $anggotaKelas->siswa_id = auth()->user()->siswa->id;
            $idkelas = Kelas::where('kode_kelas',$request->kode_kelas)->get();
            foreach ($idkelas as $item) {
                $id = $item->id;
            }
            $anggotaKelas->kelas_id = $id;

            if (AnggotaKelas::where('kelas_id',$id)->where('siswa_id',auth()->user()->siswa->id)->exists()) {
                return redirect()->route('siswa.kelas')->withSuccess('Kamu sudah tergabung dalam kelas ini');
            } else {
                $anggotaKelas->save();
                return redirect()->route('siswa.kelas')->withSuccess('Berhasil bergabung ke kelas baru');
            }
        }

        // } catch (\Exception $e) {
        //   return redirect()->back()->with('tidakditemukan','Kode Kelas tidak ditemukan');
        // }
    }

    public function showKelas($id)
    {
        $kelas              = Kelas::find($id);
        $pertemuan          = Pertemuan::where('kelas_id',$id)->paginate(4);
        $anggotakelas       = AnggotaKelas::where('kelas_id',$id)->join('siswa','anggota_kelas.siswa_id','=','siswa.id')
                            ->orderBy('siswa.nama_lengkap')->get();
        $anggota_kelas_id   = auth()->user()->siswa->anggota_kelas()->value('id');
        $kelompok_master    = KelompokMaster::where('kelas_id',$id)->get();
        $hasil_ujian        = PesertaUjian::where('anggota_kelas_id',$anggota_kelas_id)->where('status',1)->get();
    
        return view('AnggotaKelas.showKelas', ['pertemuan' => $pertemuan, 'anggotakelas' => $anggotakelas, 'kelompok_master' => $kelompok_master, 'hasil_ujian'=> $hasil_ujian], compact('kelas'));
    }

    public function showPertemuan($kelas_id, $id_pertemuan)
    {
        $pertemuan      = Pertemuan::find($id_pertemuan);
        $kelas          = Kelas::find($kelas_id);
        $anggotakelas   = AnggotaKelas::where('kelas_id',$kelas_id)->get();
        $anggota_kelas_id   = AnggotaKelas::where('kelas_id',$kelas_id)->where('siswa_id',Auth::user()->siswa->id)->value('id');
        $chat_pertemuan = ChatPertemuan::where('pertemuan_id',$pertemuan->id)->get();

        date_default_timezone_set("Asia/Jakarta"); // mengatur time zone untuk WIB.
        $waktu_mulai = date('F d, Y H:i:s', strtotime($pertemuan->waktu_mulai)); // mengubah bentuk string waktu mulai untuk digunakan pada date di js

        return view('AnggotaKelas.showPertemuan', ['pertemuan' => $pertemuan, 'anggotakelas' => $anggotakelas, 'chat_pertemuan' => $chat_pertemuan  ], compact('pertemuan','kelas','waktu_mulai','anggota_kelas_id'));
    }

    public function ruangPertemuan($kelas_id,$id_pertemuan)
    {
        $pertemuan      = Pertemuan::whereId($id_pertemuan)->first();
        $kelas          = Kelas::find($kelas_id);
        $anggotakelas   = AnggotaKelas::where('kelas_id',$kelas_id)->get();
        //$absensi        = Absensi::where('pertemuan_id',$pertemuan->id)->get();
        $chat_pertemuan = ChatPertemuan::where('pertemuan_id',$pertemuan)->get();

        date_default_timezone_set("Asia/Jakarta"); // mengatur time zone untuk WIB.
        $waktu_mulai = date('F d, Y H:i:s', strtotime($pertemuan->waktu_mulai)); // mengubah bentuk string waktu mulai untuk digunakan pada date di js

        return view('Anggotakelas.ruangPertemuan', ['pertemuan' => $pertemuan, 'anggotakelas' => $anggotakelas, 'chat_pertemuan' => $chat_pertemuan ], compact('pertemuan','kelas','waktu_mulai'));
    }

    public function absensi_create(Request $request)
    {
        if (Absensi::where('pertemuan_id',$request->pertemuan_id)->where('anggota_kelas_id',$request->anggota_kelas_id)->exists()) {
            $update_absensi = [
                'status' => 1
            ];
            $posts = Absensi::where('pertemuan_id',$request->pertemuan_id)->where('anggota_kelas_id',$request->anggota_kelas_id)->update($update_absensi);
            return response()->json($posts);
        } else {
            $absensi = new Absensi;
            $absensi->pertemuan_id = $request->pertemuan_id;
            $absensi->anggota_kelas_id = $request->anggota_kelas_id;
            $absensi->status = 1;
            $posts = $absensi->save();
            return response()->json($posts);
        }
    }


    public function hasilUjian($id){
        $peserta_ujian = PesertaUjian::find($id); 
        //soal yang belum di koreksi
        $essay_jawab = EssayJawab::where('peserta_ujian_id', $peserta_ujian->id)->where('score','!=',null)->get();
        $pilgan_jawab = PilganJawab::where('peserta_ujian_id', $peserta_ujian->id)->get();
        $koreksi_jawaban = EssayJawab::where('peserta_ujian_id', $peserta_ujian->id)->where('score','=',null)->get();
  
        $total_poin = SoalSatuan::where('paket_soal_id',$peserta_ujian->ujian->paket_soal->id)->sum('poin');
  
        $score_pilgan = PilganJawab::where('peserta_ujian_id',$peserta_ujian->id)->sum('score');
  
        if($koreksi_jawaban->count() == 0) {
            $score_essay = EssayJawab::where('peserta_ujian_id',$peserta_ujian->id)->sum('score');
            $total_score = $score_essay + $score_pilgan;
            $nilai_akhir = $total_score / $total_poin * 100;
            $nilai_akhir = substr($nilai_akhir, 0, 5);
            PesertaUjian::where('id',$id)->update([
                'nilai' => $total_score
            ]);
            return view('AnggotaKelas.hasilUjian', ['peserta_ujian' => $peserta_ujian, 'essay_jawab' => $essay_jawab, 'pilgan_jawab' => $pilgan_jawab, 'koreksi_jawaban' => $koreksi_jawaban], compact('nilai_akhir','total_poin'));
        }
  
        return view('AnggotaKelas.hasilUjian', ['peserta_ujian' => $peserta_ujian, 'essay_jawab' => $essay_jawab, 'pilgan_jawab' => $pilgan_jawab, 'koreksi_jawaban' => $koreksi_jawaban]);
      }

    public function fetchMessages($kelas_id,$id_pertemuan){
    $pertemuan      = Pertemuan::find($id_pertemuan);
    //dd($pertemuan->id);
    $chat_pertemuan = ChatPertemuan::where('pertemuan_id',$pertemuan->id)->with('user')->get();

    return $chat_pertemuan;
    }

    public function storeMessages(Request $request,$kelas_id,$id_pertemuan){
        //dd($request);
        $chat_pertemuan = ChatPertemuan::create([
            'user_id' => $request->user_id,
            'pertemuan_id' => $request->pertemuan_id,
            'pesan' => $request->pesan
        ]);
        return $chat_pertemuan;
    }
}
