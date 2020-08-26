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
use App\Events\StartDiskusi;
use App\Events\EndDiskusi;
class KelompokController extends Controller
{

    public function create($id)
    {
        $kelas_id = $id;
        $kelas = Kelas::find($id);
        return view('Kelompok.create', compact('kelas_id','kelas'));
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
        return redirect()->route('guru.kelas.show', $request->kelas_id)->with('success','Kelompok baru berhasil dibuat');
    }

    public function show($id)
    {
        $kelompok_master    = KelompokMaster::find($id);
        $kelompok           = Kelompok::where('kelompok_master_id',$kelompok_master->id)->get();
        $anggotakelas       = AnggotaKelas::where('kelas_id',$id)->get();
        return view('Kelompok.show', ['anggotakelas' => $anggotakelas], compact('kelompok_master','kelompok'));
    }

    // ruang diskusi kelompok tampilan GURU
    public function startDiskusi($pertemuan_id, $kelompok_master_id) 
    {
        $kelompok_master    = KelompokMaster::find($kelompok_master_id);
        $kelompok           = Kelompok::where('kelompok_master_id',$kelompok_master->id)->get();
        $anggotakelas       = AnggotaKelas::where('kelas_id',$kelompok_master_id)->get();    
        $update_status = [
            'status' => 1,
        ];
        $kelompok_aktif = KelompokMaster::whereId($kelompok_master_id)->update($update_status);
        // want to broadcast StartDiskusi event
        event(new StartDiskusi($kelompok_master));

        $pertemuan    = Pertemuan::find($pertemuan_id);
        return view('Kelompok.start', ['anggotakelas' => $anggotakelas], compact('kelompok_master','kelompok','pertemuan'));
    }
    public function monitorDiskusi() 
    {

    }

    public function endDiskusi($pertemuan_id, $kelompok_master_id) 
    {
        $kelompok_master    = KelompokMaster::find($kelompok_master_id);
        $kelompok           = Kelompok::where('kelompok_master_id',$kelompok_master->id)->get();
        $anggotakelas       = AnggotaKelas::where('kelas_id',$kelompok_master->kelas_id)->get();
        
        $update_status = [
            'status' => 0,
        ];
        $kelompok_nonaktif = KelompokMaster::whereId($kelompok_master_id)->update($update_status);
        $pertemuan    = Pertemuan::find($pertemuan_id);
     
        event(new EndDiskusi($kelompok_master));
        return redirect()->route('pertemuan.ruang', ['id_pertemuan' =>$pertemuan_id, 'kelas_id' => $kelompok_master->kelas_id]);

    }

    // ruang diskusi kelompok SISWA
    public function setRuangDiskusi($kelompok_master_id, $anggota_kelas_id, $pertemuan_id) 
    {
        $kelompok = Kelompok::where('kelompok_master_id', $kelompok_master_id)->get(); 
        foreach ($kelompok as $kel) { 
            $anggotakelompok = AnggotaKelompok::where('kelompok_id', $kel->id)->get(); 
            foreach ($anggotakelompok as $anggota_kel) {
                if ($anggota_kel->anggota_kelas_id == $anggota_kelas_id) {
                    $anggota_kelompok_id = $anggota_kel->id;
                }
            }         
        }
        $anggota_kelompok = AnggotaKelompok::where('id', $anggota_kelompok_id)->first();
        $kelompok_id = $anggota_kelompok->kelompok_id;
        return redirect()->route('ruangDiskusi', ['pertemuan_id' =>$pertemuan_id, 'kelompok_id' => $kelompok_id, 'anggota_kelompok_id' => $anggota_kelompok_id] );
    }

    public function ruangDiskusi($pertemuan_id, $kelompok_id, $anggota_kelompok_id) 
    {
        $kelompok   = Kelompok::find($kelompok_id);
        $pertemuan      = Pertemuan::find($pertemuan_id);
        $anggota    = AnggotaKelompok::find($anggota_kelompok_id);
        return view('AnggotaKelas.ruangDiskusi', compact('kelompok','pertemuan'));
    }
}
