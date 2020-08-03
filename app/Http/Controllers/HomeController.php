<?php

namespace App\Http\Controllers;
use App\PesertaUjian;
use Illuminate\Http\Request;
use Auth;

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
            return view('home_guru');
        } else{
            // $users['users'] = \App\user::all();
            $anggota_kelas_id = auth()->user()->siswa->anggota_kelas()->value('id');
            $peserta_ujian = PesertaUjian::where('anggota_kelas_id',$anggota_kelas_id)->where('status','!=',1)->get();
            return view('home_siswa',compact(['peserta_ujian']));
        }
    }
}
