<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('chat', function ($user) { 
    return $user;
});
// Broadcast::channel('anggota_kelas.{kelas_id}', function ($anggota_kelas, $kelas_id) {
//     // broadcast ke seluruh anggota kelas. 
//     return $anggota_kelas->kelas_id == $kelas_id;
// });

// Broadcast::channel('anggota_kelas.{kelas_id}', function ($kelas, $kelas_id) {
//     return $kelas->id === KelompokMaster::findOrNew($orderId)->user_id;
// });

Broadcast::channel('kelas.{kelasId}', function ($kelas, $kelasId) {
    return $kelas->id == $kelasId;
});