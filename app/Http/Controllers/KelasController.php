<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Str;
use App\Kelas;
use App\Guru;

class KelasController extends Controller
{
    

    public function index()
    {
        $kelas = Kelas::where('guru_id',Auth::user()->guru->id)->get();
        return view('Kelas.index',['kelas', $kelas]);
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

    public function destroy($id)
    {
        //
    }
}
