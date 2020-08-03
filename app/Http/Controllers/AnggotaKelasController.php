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
        $kelas = Kelas::find($id);
        $pertemuan = Pertemuan::where('kelas_id',$id)->get();
        $anggotakelas   = AnggotaKelas::where('kelas_id',$id)->join('siswa','anggota_kelas.siswa_id','=','siswa.id')
                          ->orderBy('siswa.nama_lengkap')->get();
        // $kelompok_saya = AnggotaKelompok::where('siswa')
        $kelompok_master_id = KelompokMaster::where('kelas_id',$id)->value('id');
        $semua_kelompok = Kelompok::where('kelompok_master_id',$kelompok_master_id)->get();
        $anggota_kelas_id = auth()->user()->siswa->anggota_kelas()->value('id');
        //dd($anggota_kelas_id);
        // $kelompok_saya = Kelompok::join('anggota_kelompok','kelompok.id','=','anggota_kelompok.kelompok_id')
        //                 ->where('anggota_kelompok.anggota_kelas_id','=',$anggota_kelas_id)->first();
        // $kelompok_saya = Kelompok::join('anggota_kelompok','kelompok.id','=','anggota_kelompok.kelompok_id')
        //                   ->where('kelompok_master_id',$kelompok_master_id)->get();

        //$kelompok_saya = AnggotaKelompok::join('kelompok','anggota_kelompok.kelompok_id','=','kelompok.id')->get();
        $kelompok_saya = Kelompok::where('kelompok_master_id',$kelompok_master_id)->first();

        //dd($kelompok_saya);
        $anggota_kelompok = AnggotaKelompok::where('kelompok_id',$kelompok_saya->id)->get();
        //dd($anggota_kelompok);

         //dd($kelompok_saya);
         // foreach ($kelompok_saya->anggota_kelompok as $item) {
         //   $data['anggota_kelas_id'] = $item->anggota_kelas_id;
         // }
         // dd($data);
        // $id_kelompok_saya = AnggotaKelompok::where('anggota_kelas_id',auth()->user);
        return view('AnggotaKelas.showKelas', ['pertemuan' => $pertemuan, 'anggotakelas' => $anggotakelas], compact('kelas','kelompok_saya','anggota_kelompok'));

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
        $pertemuan      = Pertemuan::find($id_pertemuan);
        $kelas          = Kelas::find($kelas_id);
        $anggotakelas   = AnggotaKelas::where('kelas_id',$kelas_id)->get();
        $absensi        = Absensi::where('pertemuan_id',$pertemuan->id)->get();
        $chat_pertemuan = ChatPertemuan::where('pertemuan_id',$pertemuan->id)->get();

        date_default_timezone_set("Asia/Jakarta"); // mengatur time zone untuk WIB.
        $waktu_mulai = date('F d, Y H:i:s', strtotime($pertemuan->waktu_mulai)); // mengubah bentuk string waktu mulai untuk digunakan pada date di js

        return view('Anggotakelas.ruangPertemuan', ['pertemuan' => $pertemuan, 'anggotakelas' => $anggotakelas, 'absensi' => $absensi, 'chat_pertemuan' => $chat_pertemuan ], compact('pertemuan','kelas','waktu_mulai'));
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
}
