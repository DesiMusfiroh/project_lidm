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
use App\AnggotaKelompok;

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
        //dd($kelas);
        $pertemuan      = Pertemuan::where('kelas_id',$id)->get();
        if (KelompokMaster::where('kelas_id',$kelas->id)->exists()) {

          $kelompok_master = KelompokMaster::where('kelas_id',$kelas->id)->first();
          $kelompok = Kelompok::where('kelompok_master_id',$kelompok_master->id)->get();
          $anggotakelas   = AnggotaKelas::where('kelas_id',$id)->get();
          return view('Kelas.show', ['pertemuan' => $pertemuan, 'anggotakelas' => $anggotakelas], compact('kelas','kelompok_master','kelompok'));
        }

        //dd($kelompok_master);
        //dd($kelompok_master_id)
        //$kelompok = Kelompok::where('kelompok_master_id',$kelompok_master->id)->get();

        $anggotakelas   = AnggotaKelas::where('kelas_id',$id)->get();
        return view('Kelas.show', ['pertemuan' => $pertemuan, 'anggotakelas' => $anggotakelas], compact('kelas'));
    }


    public function storeKelompok(Request $request)
    {
      $anggota_kelas = AnggotaKelas::where('kelas_id',$request->kelas_id)->inRandomOrder()->get('id');
      //dd($anggota_kelas);
      $jumlah_anggota_kelas = count($anggota_kelas);
      //dd($jumlah_anggota_kelas);
      $jml_kel = intval(ceil($jumlah_anggota_kelas/ $request->jumlah_kelompok));
      // dd($jml_kel);
      $array_kelompok = $anggota_kelas->split($jml_kel);
      $array_kelompok->toArray();
      //dd($groups);
      //dd($array_kelompok);
      $kelompok_master = new KelompokMaster;
      $kelompok_master->kelas_id = $request->kelas_id;
      $kelompok_master->deskripsi = $request->deskripsi;
      $kelompok_master->jumlah_kelompok = $jml_kel;
      $kelompok_master->status = 0;
      $kelompok_master->save();
      //dd($kelompok_master);
      for ($i=0; $i < $jml_kel ; $i++) {
        $kelompok = new Kelompok;
        $kelompok->kelompok_master_id = $kelompok_master->id;
        $kelompok->nama_kelompok = "Kelompok ".$i;
        $kelompok->save();

        // foreach ($array_kelompok as $key => $kel) {
        //   //dd($kel);
        //   $data['kelompok_id'] = $kelompok->id;
        //   $data['anggota_kelas_id'] = $kel->id;
        //   AnggotaKelompok::create($data);
        // }
        foreach ($array_kelompok as $key=>$anggota_kelompok) {
          //dd($anggota_kelompok);
          $data = array(
            'kelompok_id' => $kelompok->id,
            'anggota_kelas_id' => $anggota_kelompok[$i]->id
          );

          AnggotaKelompok::create($data);
        }

        //$anggota_kelompok = new AnggotaKelompok;

      }
      return redirect()->back();
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
