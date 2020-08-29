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
        //dd($kelas_id);
        intval($kelas_id);
        //dd($kelas_id);
        $kelas = Kelas::whereId($kelas_id)->first();
        //dd($kelas);
        //dd($kelas);
        $pertemuan = Pertemuan::where('kelas_id', $kelas_id)->get();
        $kelompok_master = KelompokMaster::where('kelas_id', $kelas_id)->get();
        return view('Tugas.create', ['pertemuan' => $pertemuan,'kelompok_master' => $kelompok_master], compact('kelas_id','kelas'));
    }

  //Simpan Tugas Individu Master
  public function tugas_individu_master_store(Request $request)
  {

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

      return redirect()->route('guru.kelas.show', $request->kelas_id)->with('success','Tugas Individu Berhasil Dibuat');
    }

  // SISWA-----------------------
  public function serahkan_tugas_individu(Request $request){

        $kumpul_tugas_individu = KumpulTugasIndividu::findOrFail($request->id);

        $file = $request->file('tugas');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'tugas';
        $file->move($tujuan_upload,$nama_file);

        $update_kumpul_tugas_individu= [
            'tugas' => $nama_file
        ];
        KumpulTugasIndividu::where('id', $request->id)->update($update_kumpul_tugas_individu);
        return redirect()->back()->with('success','Tugas Berhasil Diserahkan');
    }

    //SISWA ---------------------------------
    public function update_tugas_individu(Request $request){
        $kumpul_tugas_individu = KumpulTugasIndividu::findOrFail($request->id);
        $file = $request->file('tugas');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'tugas';
        $file->move($tujuan_upload,$nama_file);

        $update_tugas= [
            'tugas' => $nama_file,
        ];
        $kumpul_tugas_individu->update($update_tugas);
        return redirect()->back()->with('success','Tugas Berhasil Diubah');
    }

    public function semuaTugas($id){
      $kelas = Kelas::find($id);
      $siswa_id = Siswa::whereId(auth()->user()->siswa->id)->value('id');
      $anggota_kelas_id = AnggotaKelas::where('siswa_id',$siswa_id)->value('id');
      $kumpul_tugas_individu = KumpulTugasIndividu::where('anggota_kelas_id',$anggota_kelas_id)->get();
      return view('AnggotaKelas.semuaTugas',compact(['kelas','siswa_id','anggota_kelas_id','kumpul_tugas_individu']));
    }

    public function beri_nilai_tugas_individu(Request $request){
        $kumpul_tugas_individu = KumpulTugasIndividu::findOrFail($request->id);

        $update_tugas= [
            'nilai' => $request->nilai,
        ];
        $kumpul_tugas_individu->update($update_tugas);
        return redirect()->back()->with('success','Nilai Telah diberikan');
    }

 //Simpan Tugas Kelompok Master GURU -------------------
 public function tugas_kelompok_master_store(Request $request)
 {

// dd($request);
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
            return redirect()->route('guru.kelas.show', $request->kelas_id)->with('success','Tugas Kelompok Berhasil Dibuat');
    }
    //Serahkan Tugas Kelompok
    public function serahkan_tugas_kelompok(Request $request){

        $kumpul_tugas_kelompok = KumpulTugasKelompok::findOrFail($request->id);

        $file = $request->file('tugas');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'tugas';
        $file->move($tujuan_upload,$nama_file);

        $update_kumpul_tugas_kelompok= [
            'tugas' => $file
        ];
        KumpulTugasKelompok::where('id', $request->id)->update($update_kumpul_tugas_kelompok);
        return redirect()->back()->with('success','Tugas Berhasil Diserahkan');
    }



    public function showTugasIndividu($id, Kelas $kelas_id)
    {
        // intval($kelas_id);
        // dd($kelas_id);

      $kelas = TugasIndividuMaster::whereId($id)->value('kelas_id');
    //   dd($kelas);
      $tugas_individu_master = TugasIndividuMaster::find($id);
      $tugas_individu_master_id = TugasIndividuMaster::whereId($id)->value('id');
      $tugas_individu = TugasIndividu::where('tugas_individu_master_id',$tugas_individu_master_id)->first();
      //dd($tugas_individu);
      $kumpul_tugas_individu = KumpulTugasIndividu::where('tugas_individu_id',$tugas_individu->id)->get();

      //
      return view('Tugas.showTugasIndividu',compact(['tugas_individu_master','tugas_individu','kumpul_tugas_individu','kelas','kelas_id']));
    }
    public function store(Request $request)
    {

    }

    public function editNilaiTugasIndividu(Request $request,$id_kumpul_tugas_individu)
    {
      return $request->all();
      //dd("oke");
    }

    public function update(Request $request, $id)
    {
        //
    }

}
