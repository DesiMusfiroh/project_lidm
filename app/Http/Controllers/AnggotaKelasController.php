<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;
use App\Siswa;
use App\AnggotaKelas;
use App\Pertemuan;


use Auth;


class AnggotaKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
          $anggotaKelas = AnggotaKelas::where('siswa_id',Auth::user()->siswa->id)->get();
          return view('AnggotaKelas.index',['anggotaKelas' => $anggotaKelas]);
        } catch (\Exception $e) {
          return redirect()->route('siswa.profil')->with('pesan','Mohon lengkapi profil anda');
        }

    }

    public function gabungKelas(Request $request){
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
              }else {
                $anggotaKelas->save();
                return redirect()->route('siswa.kelas')->withSuccess('Berhasil bergabung ke kelas baru');
              }
          }

        // } catch (\Exception $e) {
        //   return redirect()->back()->with('tidakditemukan','Kode Kelas tidak ditemukan');
        // }
}


    public function showKelas($id){

        $kelas = Kelas::find($id);
        $pertemuan = Pertemuan::where('kelas_id',$id)->get();
        $anggotakelas   = AnggotaKelas::where('kelas_id',$id)->get();
        return view('AnggotaKelas.showKelas', ['pertemuan' => $pertemuan, 'anggotakelas' => $anggotakelas], compact('kelas'));

    }
    public function showPertemuan($kelas_id, $id_pertemuan){

        $pertemuan      = Pertemuan::find($id_pertemuan);
        $kelas          = Kelas::find($kelas_id);
        $anggotakelas   = AnggotaKelas::where('kelas_id',$kelas_id)->get();
        return view('AnggotaKelas.showPertemuan', ['pertemuan' => $pertemuan, 'anggotakelas' => $anggotakelas, ], compact('pertemuan','kelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
