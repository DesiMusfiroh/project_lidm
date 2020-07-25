<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;

class PertemuanController extends Controller
{
    public function create($id)
    {
        $kelas = Kelas::find($id);
        return view('Pertemuan.create', compact('kelas'));
    }
}
