<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Guru;

class GuruController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
        return view('Guru/index');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'user_id' => 'required',
            'nama_lengkap' => 'required',
            'nip' => 'required',
            'no_hp' => 'required',
            'instansi' => 'required',
            'alamat' => 'required',
            'jk' => 'required',
            'foto' => 'required|file|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $file = $request->file('foto');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'images';
        $file->move($tujuan_upload,$nama_file);

        $profil = Guru::create([
            'user_id' => $request->user_id,
            'nama_lengkap' => $request->nama_lengkap,
            'nip' => $request->nip,
            'no_hp' => $request->no_hp,
            'instansi' => $request->instansi,
            'alamat' => $request->alamat,
            'jk' => $request->jk,
            'foto' => $nama_file,
        ]);
        return redirect()->back()
        ->with('success','Data Profil berhasil di simpan');
    }

    public function edit()
    {
        $guru = Guru::find(Auth::user()->guru->id);
        return view('Guru/edit',['guru' => $guru]);
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'user_id' => 'required',
            'nama_lengkap' => 'required',
            'nip' => 'required',
            'no_hp' => 'required',
            'instansi' => 'required',
            'alamat' => 'required',
            'jk' => 'required',
            'foto' => 'nullable|file|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $guru = Guru::find(Auth::user()->guru->id); //tampilkan profil
        $nama_file= $guru->foto; //simpan nama file foto yang sudah ada

        if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'images';
        $file->move($tujuan_upload,$nama_file);
        }
        $update = [
            'user_id' => $request->user_id,
            'nama_lengkap' => $request->nama_lengkap,
            'nip' => $request->nip,
            'no_hp' => $request->no_hp,
            'instansi' => $request->instansi,
            'alamat' => $request->alamat,
            'jk' => $request->jk,
            'foto' => $nama_file,
        ];

        Guru::whereId($guru->id)->update($update);

        return redirect()->route('guru.profil')->with('success','Data Profil berhasil di update');
    }

}
