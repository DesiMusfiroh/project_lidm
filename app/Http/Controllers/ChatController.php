<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChatPertemuan;
use App\ChatKelompok;

class ChatController extends Controller
{
    public function chat_pertemuan_send(Request $request) {
        $posts = $chat_pertemuan = ChatPertemuan::create([
            'user_id' => $request->user_id,
            'pertemuan_id' => $request->pertemuan_id,
            'pesan' => $request->pesan
        ]);
        return response()->json($posts);
    }

    public function chat_kelompok_send(Request $request) {
        $posts = $chat_kelompok = Chatkelompok::create([
            'user_id' => $request->user_id,
            'kelompok_id' => $request->kelompok_id,
            'pesan' => $request->pesan
        ]);
        return response()->json($posts);
    }
}
