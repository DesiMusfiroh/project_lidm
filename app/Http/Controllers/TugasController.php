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
use App\TugasIndividuMaster;
use App\TugasIndividu;


class TugasController extends Controller
{

    public function create($id)
    {
        $kelas_id = $id;
        $pertemuan = Pertemuan::where('kelas_id', $kelas_id)->get();
        return view('Tugas.create', ['pertemuan' => $pertemuan], compact('kelas_id'));
    }

  //Simpan Tugas Individu Master
  public function tugas_individu_master_store(Request $request)
  {     
//   dd($request);
      
      $this->validate($request,[
          'kelas_id'  => 'required',
          'nama_tugas'   => 'required',
          'pertemuan' => 'required',
          'deadline' => 'required',
          'jenis' => 'required',

      ]);
       $tugas_individu_master = new TugasIndividuMaster;
       $tugas_individu_master = TugasIndividuMaster::create([
          'kelas_id'                => $request->kelas_id,
          'jenis'                   => $request->jenis,
          'nama_tugas'              => $request->nama_tugas,
          'pertemuan'               => $request->pertemuan,
          'deadline'                => $request->deadline,
          ]);

      $kelas_id = $request->kelas_id;
      $tugas_individu_master = TugasIndividuMaster::where('kelas_id',$kelas_id)->orderBy('id','asc')->get();
      return redirect()->route('tugas.create',['kelas_id' => $kelas_id])->with('success','Tugas Individu Berhasil Dibuat');;
  }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

}
