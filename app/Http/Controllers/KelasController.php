<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Str;
use App\Kelas;
use App\Guru;
use App\Siswa;
use App\Pertemuan; 
use App\AnggotaKelas;
use App\KelompokMaster;
use App\Kelompok;
use App\AnggotaKelompok;
use App\TugasIndividuMaster;
use App\TugasKelompokMaster;


class KelasController extends Controller
{


    public function index()
    {
        try {
            $kelas         = Kelas::where('guru_id',Auth::user()->guru->id)->get();
            return view('Kelas.index',['kelas' => $kelas]);
          } catch (\Exception $e) {
            return redirect()->route('guru.profil')->with('error','Mohon lengkapi profil anda');
          }
  

       
    }

    public function create()
    { 
        try {
        $kelas         = Kelas::where('guru_id',Auth::user()->guru->id)->get();
        return view('Kelas.create',['kelas' => $kelas]);
      } catch (\Exception $e) {
        return redirect()->route('guru.profil')->with('error','Mohon lengkapi profil anda');
      }
        
    }
    
    public function store(Request $request)
    {
        $kode_kelas = Str::random(6);
        $guru_id = Auth::user()->guru->id;
        $kelas = Kelas::create([
            'guru_id' => $guru_id,
            'nama_kelas' => $request->nama_kelas,
            'deskripsi' => $request->deskripsi,
            'kode_kelas' => $kode_kelas,
        ]);
        return redirect()->route('guru.kelas')->with('success','Kelas baru berhasil dibuat');
    }

    public function show($id)
    {
        $kelas           = Kelas::find($id);
        $pertemuan       = Pertemuan::where('kelas_id',$id)->paginate(5);
        $anggotakelas    = AnggotaKelas::where('kelas_id',$id)->join('siswa','anggota_kelas.siswa_id','=','siswa.id')
                          ->orderBy('siswa.nama_lengkap')->get();
        $kelompok_master = KelompokMaster::where('kelas_id',$id)->paginate(5);
        $tugas_individu_master = TugasIndividuMaster::where('kelas_id',$id)->paginate(5);
        $tugas_kelompok_master = TugasKelompokMaster::where('kelas_id',$id)->paginate(5);

        // if (KelompokMaster::where('kelas_id',$kelas->id)->exists()) {

        //   $kelompok_master = KelompokMaster::where('kelas_id',$kelas->id)->first();
        //   $kelompok = Kelompok::where('kelompok_master_id',$kelompok_master->id)->get();
        //   $anggotakelas   = AnggotaKelas::where('kelas_id',$id)->get();
        //   return view('Kelas.show', ['pertemuan' => $pertemuan, 'anggotakelas' => $anggotakelas], compact('kelas','kelompok_master','kelompok'));
        // }

        return view('Kelas.show', ['pertemuan' => $pertemuan, 'anggotakelas' => $anggotakelas, 'kelompok_master' => $kelompok_master,'tugas_individu_master' => $tugas_individu_master,'tugas_kelompok_master' => $tugas_kelompok_master], compact('kelas'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
