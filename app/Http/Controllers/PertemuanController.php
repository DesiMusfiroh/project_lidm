<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;
use App\Pertemuan;
use App\AnggotaKelas;

class PertemuanController extends Controller
{
    public function create($id)
    {
        $kelas = Kelas::find($id);
        return view('Pertemuan.create', compact('kelas'));
    }
    public function store(Request $request)
    {
        $pertemuan = Pertemuan::create([
            'kelas_id' => $request->kelas_id,
            'nama_pertemuan' => $request->nama_pertemuan,
            'deskripsi' => $request->deskripsi,
            'waktu_mulai' => $request->waktu_mulai,
            'status' => 0,
        ]);
        return redirect()->route('guru.kelas.show',$request->kelas_id)->with('success','Pertemuan baru berhasil dibuat');
    }
    public function show($id)
    {
        $pertemuan      = Pertemuan::find($id);
        $kelas          = Kelas::find($id);
        $anggotakelas   = AnggotaKelas::where('kelas_id',$id)->get();
        return view('Pertemuan.show', ['pertemuan' => $pertemuan, 'anggotakelas' => $anggotakelas, ], compact('pertemuan','kelas'));
    }
}
