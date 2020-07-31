<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Str;
use App\Kelas;
use App\Guru;
use App\Pertemuan;
use App\AnggotaKelas;
use App\KelompokMaster;
use App\Kelompok;

class KelasController extends Controller
{


    public function index()
    {
        $kelas = Kelas::where('guru_id',Auth::user()->guru->id)->get();
        return view('Kelas.index',['kelas' => $kelas]);
    }

    public function create()
    {
        return view('Kelas.create');
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
        $kelas          = Kelas::find($id);
        //dd($kelas);
        $pertemuan      = Pertemuan::where('kelas_id',$id)->get();
        $anggotakelas   = AnggotaKelas::where('kelas_id',$id)->get();
        return view('Kelas.show', ['pertemuan' => $pertemuan, 'anggotakelas' => $anggotakelas], compact('kelas'));
    }


    public function storeKelompok(Request $request)
    {
      $anggota_kelas = AnggotaKelas::where('kelas_id',$request->kelas_id)->get('id');
      //dd($anggota_kelas);
      $jumlah_anggota_kelas = count($anggota_kelas);
      //dd($jumlah_anggota_kelas);
      $jml_kel = intval(ceil($jumlah_anggota_kelas/ $request->jumlah_kelompok));
      // dd($jml_kel);
      $kelompok_master = new KelompokMaster;
      $kelompok_master->kelas_id = $request->kelas_id;
      $kelompok_master->deskripsi = $request->deskripsi;
      $kelompok_master->jumlah_kelompok = $jml_kel;
      $kelompok_master->status = 0;
      $kelompok_master->save();
      //dd($kelompok_master);
      for ($i=1; $i <= $jml_kel ; $i++) {
        $kelompok = new Kelompok;
        $kelompok->kelompok_master_id = $kelompok_master->id;
        $kelompok->nama_kelompok = "Kelompok ".$i;
        $kelompok->save();
        
      }
      dd("oke");
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
