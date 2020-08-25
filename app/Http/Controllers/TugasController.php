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
use App\KumpulTugasIndividu;
use App\TugasKelompokMaster;
use App\TugasKelompok;
use App\KumpulTugasKelompok;



class TugasController extends Controller
{

    public function create($kelas_id)
    {
        // $kelas_id = $id;
        $pertemuan = Pertemuan::where('kelas_id', $kelas_id)->get();
        $kelompok_master = KelompokMaster::where('kelas_id', $kelas_id)->get();
        return view('Tugas.create', ['pertemuan' => $pertemuan,'kelompok_master' => $kelompok_master], compact('kelas_id'));
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

      ]);
       //$tugas_individu_master = new TugasIndividuMaster;
       $tugas_individu_master = TugasIndividuMaster::create([
          'kelas_id'                => $request->kelas_id,
          'nama_tugas'              => $request->nama_tugas,
          'pertemuan'               => $request->pertemuan,
          'deadline'                => $request->deadline,
          ]);
        $anggota_kelas = AnggotaKelas::where('kelas_id',$request->kelas_id)->get();
        $tugas_individu = TugasIndividu::create([
            'tugas_individu_master_id' => $tugas_individu_master->id,
            'status' => false
        ]);
        foreach ($anggota_kelas as $e => $anggota) {
            $data['tugas_individu_id'] = $tugas_individu->id;
            $data['anggota_kelas_id'] = $anggota->id;
            $data['tugas'] = null;
            $data['nilai'] = 0;
  
            KumpulTugasIndividu::create($data);
          }

    $kelas_id = $request->kelas_id;
    //   $tugas_individu_master = TugasIndividuMaster::where('kelas_id',$kelas_id)->orderBy('id','asc')->get();
      return redirect()->route('tugas.create',['kelas_id' => $kelas_id])->with('success','Tugas Individu Berhasil Dibuat');;
  }
 
  public function serahkan_tugas_individu(Request $request){
      
        $kumpul_tugas_individu = KumpulTugasIndividu::findOrFail($request->id);
        
        $file = $request->file('tugas');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'tugas';
        $file->move($tujuan_upload,$nama_file);

        $update_kumpul_tugas_individu= [
            'tugas' => $file
        ];
        KumpulTugasIndividu::where('id', $request->id)->update($update_kumpul_tugas_individu);
        return redirect()->back();
    }
    
    public function update_tugas_individu(Request $request){
        $kumpul_tugas_individu = KumpulTugasIndividu::findOrFail($request->id);  
        $file = $request->file('tugas');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'tugas';
        $file->move($tujuan_upload,$nama_file);

        $update_tugas= [
            'tugas' => $file,
        ];
        $kumpul_tugas_individu->update($update_tugas);
        return redirect()->back();
    }

 //Simpan Tugas Kelompok Master
 public function tugas_kelompok_master_store(Request $request)
 {     
     
     $this->validate($request,[
         'kelas_id'             => 'required',
         'kelompok_master_id'   => 'required',
         'nama_tugas'           => 'required',
         'deadline'             => 'required',

     ]);
     
      $tugas_kelompok_master = TugasKelompokMaster::create([
         'kelas_id'                         => $request->kelas_id,         
         'kelompok_master_id'               => $request->kelompok_master_id,
         'nama_tugas'                       => $request->nama_tugas,
         'deadline'                         => $request->deadline,
         ]);
       $kelompok = Kelompok::where('kelompok_master_id',$request->kelompok_master_id)->get();
       $tugas_kelompok= TugasKelompok::create([
           'tugas_kelompok_master_id' => $tugas_kelompok_master->id,
           'status' => false
       ]);
       foreach ($kelompok as $e => $kel) {
           $data['tugas_kelompok_id'] = $tugas_kelompok->id;
           $data['kelompok_id'] = $kel->id;
           $data['tugas'] = null;
           $data['nilai'] = 0;
 
           KumpulTugasKelompok::create($data);
         }

   $kelas_id = $request->kelas_id;
   //   $tugas_individu_master = TugasIndividuMaster::where('kelas_id',$kelas_id)->orderBy('id','asc')->get();
     return redirect()->route('tugas.create',['kelas_id' => $kelas_id])->with('success','Tugas Kelompok Berhasil Dibuat');;
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
