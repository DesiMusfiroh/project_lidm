<?php

namespace App\Http\Controllers;
use App\PesertaUjian;
use App\Guru;
use App\Kelas;
use App\AnggotaKelas;
use Illuminate\Http\Request;
use Auth;
use Alert2;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == 1){
            $guru_id = Guru::where('id',auth()->user()->guru->id)->value('id');
            $kelas_guru = Kelas::where('guru_id',$guru_id)->get();
            //dd($kelas_guru);
            $siswaku = AnggotaKelas::whereIn('kelas_id',$kelas_guru)->count();
            //dd($anggota_kelas);
            return view('home_guru',compact(['kelas_guru','siswaku']));
        } else {
            return view('home_siswa');
        }

    }
}
