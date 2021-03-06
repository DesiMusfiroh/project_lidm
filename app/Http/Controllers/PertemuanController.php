<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Kelas;
use App\Pertemuan;
use App\AnggotaKelas;
use App\Absensi;
use App\ChatPertemuan;
use App\KelompokMaster;
use App\Events\ChatEvent; 
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
        return redirect()->route('guru.kelas.show',$request->kelas_id)->withSuccess('Pertemuan baru berhasil dibuat !');
    }

     //Update Pertemuan
     public function updatePertemuan(Request $request){
        try {
          $pertemuan = Pertemuan::FindOrFail($request->id);
          $update_pertemuan = [
              'nama_pertemuan' => $request->nama_pertemuan,
              'deskripsi' => $request->deskripsi,
              'waktu_mulai' => $request->waktu_mulai,
          ];
          $pertemuan->update($update_pertemuan);
          return redirect()->back()->withSuccess('Perubahan berhasil disimpan');
        } catch (\Exception $e) {
          return redirect()->back()->with('pesan','Pastikan tidak ada kolom yang kosong');
        }
    }
    public function show($kelas_id,$id_pertemuan)
    {
        $pertemuan      = Pertemuan::find($id_pertemuan);
        $kelas          = Kelas::find($kelas_id);
        $anggotakelas   = AnggotaKelas::where('kelas_id',$kelas_id)->get();
        $absensi        = Absensi::where('pertemuan_id',$pertemuan->id)->get();
        $chat_pertemuan = ChatPertemuan::where('pertemuan_id',$pertemuan->id)->get();

        date_default_timezone_set("Asia/Jakarta"); // mengatur time zone untuk WIB.
        $waktu_mulai = date('F d, Y H:i:s', strtotime($pertemuan->waktu_mulai)); // mengubah bentuk string waktu mulai untuk digunakan pada date di js

        return view('Pertemuan.show', ['pertemuan' => $pertemuan, 'anggotakelas' => $anggotakelas, 'absensi' => $absensi, 'chat_pertemuan' => $chat_pertemuan ], compact('pertemuan','kelas','waktu_mulai'));
    }
  
    public function pertemuan_start(Request $request) {
        $update_status_pertemuan = [
            'status' => 1
        ];
        $posts = Pertemuan::where('id',$request->pertemuan_id)->update($update_status_pertemuan);
        return response()->json($posts);
    }
    public function pertemuan_end(Request $request) {  
        $update_status_pertemuan = [
            'status' => 2
        ];
        $posts = Pertemuan::where('id',$request->pertemuan_id)->update($update_status_pertemuan);
        return response()->json($posts);
    }

    public function ruang($kelas_id,$id_pertemuan)
    {
        //dd($kelas_id);
        //dd($id_pertemuan);
        $pertemuan      = Pertemuan::whereId($id_pertemuan)->first();
        
        $kelas          = Kelas::find($kelas_id);
        $anggotakelas   = AnggotaKelas::where('kelas_id',$kelas_id)->get();
        $absensi        = Absensi::where('pertemuan_id',$pertemuan->id)->get();
        $chat_pertemuan = ChatPertemuan::where('pertemuan_id',$pertemuan->id)->get();
        $kelompok_master= KelompokMaster::where('kelas_id',$kelas_id)->get();

        date_default_timezone_set("Asia/Jakarta"); // mengatur time zone untuk WIB.
        $waktu_mulai = date('F d, Y H:i:s', strtotime($pertemuan->waktu_mulai)); // mengubah bentuk string waktu mulai untuk digunakan pada date di js

        return view('Pertemuan.ruang', ['pertemuan' => $pertemuan, 'anggotakelas' => $anggotakelas, 'absensi'=> $absensi, 'chat_pertemuan' => $chat_pertemuan, 'kelompok_master' =>$kelompok_master ], compact('pertemuan','kelas','waktu_mulai'));
    }

    public function fetchMessages($kelas_id,$id_pertemuan){
        $pertemuan      = Pertemuan::find($id_pertemuan);
        //dd($pertemuan->id);
        $chat_pertemuan = ChatPertemuan::where('pertemuan_id',$pertemuan->id)->with('user')->get();

        return $chat_pertemuan;
    }

    public function storeMessages(Request $request,$kelas_id,$id_pertemuan){
        //dd($request);
        $chat = auth()->user()->chat_pertemuan()->create([
            
            'pertemuan_id' => $request->pertemuan_id,
            'pesan' => $request->pesan
        ]);
        broadcast(new ChatEvent($chat->load('user')))->toOthers();
        
        return ['status' => 'success'];
    }

    public function end($id) {
        $update_status_pertemuan = [
            'status' => 2
        ];
        $posts = Pertemuan::where('id',$id)->update($update_status_pertemuan);
        $pertemuan = Pertemuan::where('id',$id)->first();
        $kelas_id = $pertemuan->kelas_id;
        return redirect()->route('pertemuan.show',['kelas_id'=>$kelas_id,'id_pertemuan'=>$pertemuan->id]);
    }
}
