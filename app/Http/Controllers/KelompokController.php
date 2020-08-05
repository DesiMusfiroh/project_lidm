<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Kelas;
use App\Guru;
use App\Siswa;
use App\Pertemuan;
use App\AnggotaKelas;
use App\KelompokMaster;
use App\Kelompok;
use App\AnggotaKelompok;

class KelompokController extends Controller
{

    public function create($id)
    {
        $kelas_id = $id;
        return view('Kelompok.create', compact('kelas_id'));
    }

    public function store(Request $request)
    {
        $anggota_kelas = AnggotaKelas::where('kelas_id',$request->kelas_id)->inRandomOrder()->get('id');
        $jumlah_anggota_kelas = count($anggota_kelas);
        $jml_kel = intval($request->jumlah_kelompok);
        $array_kelompok = $anggota_kelas->split($jml_kel); // mengelompokkan array seluruh siswa tadi. menjadi beberapa kelompok
        $array_kelompok->toArray();

        $kelompok_master = new KelompokMaster;
        $kelompok_master->kelas_id = $request->kelas_id;
        $kelompok_master->deskripsi = $request->deskripsi;
        $kelompok_master->jumlah_kelompok = $jml_kel;
        $kelompok_master->status = 0;
        $kelompok_master->save();

        for ($i=0; $i < $jml_kel ; $i++) {
            $kelompok = new Kelompok;
            $kelompok->kelompok_master_id = $kelompok_master->id;
            $kelompok->nama_kelompok = "Kelompok ".($i+1);
            $kelompok->save();

            foreach ($array_kelompok[$i] as $key=>$anggota_kelompok) {
            $data = array(
                'kelompok_id' => $kelompok->id,
                'anggota_kelas_id' => $anggota_kelompok->id
            );
            AnggotaKelompok::create($data);
            }
        }
        return redirect()->route('guru.kelas.show', $request->kelas_id);
    }

    public function show($id)
    {
        $kelompok_master    = KelompokMaster::find($id);
        $kelompok           = Kelompok::where('kelompok_master_id',$kelompok_master->id)->get();
        $anggotakelas       = AnggotaKelas::where('kelas_id',$id)->get();
        return view('Kelompok.show', ['anggotakelas' => $anggotakelas], compact('kelompok_master','kelompok'));
    }

}
