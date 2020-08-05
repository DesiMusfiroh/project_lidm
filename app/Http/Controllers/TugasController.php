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

class TugasController extends Controller
{

    public function create($id)
    {
        $kelas_id = $id;
        $pertemuan = Pertemuan::where('kelas_id', $kelas_id)->get();
        return view('Tugas.create', ['pertemuan' => $pertemuan], compact('kelas_id'));
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
