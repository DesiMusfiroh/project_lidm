<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Siswa;
use App\PesertaUjian;

class SiswaController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {

        $siswa = Siswa::where('user_id', Auth::user()->id )->first();
        return view('Siswa/index',compact(['siswa']));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'user_id' => 'required',
            'nama_lengkap' => 'required',
            'nomor_induk' => 'required',
            'no_hp' => 'required',
            'instansi' => 'required',
            'alamat' => 'required',
            'jk' => 'required',
            'angkatan' => 'required',
            'foto' => 'required|file|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $file = $request->file('foto');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'images';
        $file->move($tujuan_upload,$nama_file);

        $profil = Siswa::create([
            'user_id' => $request->user_id,
            'nama_lengkap' => $request->nama_lengkap,
            'nomor_induk' => $request->nomor_induk,
            'no_hp' => $request->no_hp,
            'instansi' => $request->instansi,
            'alamat' => $request->alamat,
            'jk' => $request->jk,
            'angkatan' => $request->angkatan,
            'foto' => $nama_file,
        ]);
        return redirect()->back()
        ->with('success','Data Profil berhasil di simpan');
    }

    public function edit()
    {
        $siswa = Siswa::find(Auth::user()->siswa->id);
        return view('Siswa/edit',['siswa' => $siswa]);
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'user_id' => 'required',
            'nama_lengkap' => 'required',
            'nomor_induk' => 'required',
            'no_hp' => 'required',
            'instansi' => 'required',
            'alamat' => 'required',
            'jk' => 'required',
            'angkatan' => 'required',
            'foto' => 'nullable|file|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $siswa = Siswa::find(Auth::user()->siswa->id); //tampilkan profil
        $nama_file= $siswa->foto; //simpan nama file foto yang sudah ada

        if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'images';
        $file->move($tujuan_upload,$nama_file);
        }
        $update = [
            'user_id' => $request->user_id,
            'nama_lengkap' => $request->nama_lengkap,
            'nomor_induk' => $request->nomor_induk,
            'no_hp' => $request->no_hp,
            'instansi' => $request->instansi,
            'alamat' => $request->alamat,
            'jk' => $request->jk,
            'angkatan' => $request->angkatan,
            'foto' => $nama_file,
        ];

        Siswa::whereId($siswa->id)->update($update);

        return redirect()->route('siswa.profil')->with('success','Data Profil berhasil di update');
    }

    public function indexUjian(){
        // $id = auth()->user()->siswa->anggota_kelas()->first()->id;
        // dd($id);
        //($id);
        // $id = auth()->user()->siswa->with('anggota_kelas:id')->get();
        // dd($id);

        // $current_user = PesertaUjian::where('anggota_kelas_id',auth()->user()->siswa->anggota_kelas->id)->get();
        // $current_user = PesertaUjian::where('anggota_kelas_id',auth()->user()->siswa->id)->with('anggota_kelas:auth')->get();
        // $current_user = PesertaUjian::where('anggota_kelas_id',$id->anggota_kelas()->id)->get();

        //dd($current_user);
        //$anggota_kelas_id = $current_user->siswa->anggota_kelas->id->get();
        //dd($anggota_kelas_id);
        $id = auth()->user()->siswa->anggota_kelas()->value('id');
        //dd($id);
        //dd($id);
        $peserta = PesertaUjian::where('anggota_kelas_id',$id)->get();
        //dd($ujian_yg_saya_ikuti);

        return view('Ujian-Siswa.index',compact(['peserta']));
    }

}
