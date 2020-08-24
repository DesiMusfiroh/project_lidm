<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/ 

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/register/guru', function () { return view('auth.register_guru'); });
Route::get('/register/siswa', function () { return view('auth.register_siswa'); });

// ROUTE SISWA  -----------------------------------------------------------------------------------------
Route::group(['prefix' => 'siswa'], function () {
    // route kelola profil siswa
    Route::group(['prefix' => 'profil'], function () {
        Route::get('/','SiswaController@index')->name('siswa.profil');
        Route::post('/store','SiswaController@store')->name('siswa.profil.store');
        Route::get('/edit','SiswaController@edit')->name('siswa.profil.edit');
        Route::patch('/update','SiswaController@update')->name('siswa.profil.update');
    });
    // route kelola kelas siswa
    Route::group(['prefix' => 'kelas'], function () {
        Route::get('/index','AnggotaKelasController@index')->name('siswa.kelas');
        Route::post('/gabungkelas','AnggotaKelasController@gabungKelas')->name('gabungKelas');
        Route::get('/show/{id}','AnggotaKelasController@showKelas')->name('siswa.kelas.show');
        Route::get('/hasilujian/{id}','AnggotaKelasController@hasilUjian')->name('hasilUjian');

        Route::group(['prefix' => 'pertemuan'], function () {
          Route::get('/show/{kelas_id}/{id_pertemuan}','AnggotaKelasController@showPertemuan',['$kelas_id'=>'kelas_id','$id_pertemuan'=>'id_pertemuan'])->name('pertemuanSiswa.show');
          Route::get('/ruang/{kelas_id}/{id_pertemuan}','AnggotaKelasController@ruangPertemuan',['$kelas_id'=>'kelas_id','$id_pertemuan'=>'id_pertemuan'])->name('pertemuanSiswa.ruang');
          Route::get('/chat/{kelas_id}/{id_pertemuan}','AnggotaKelasController@fetchMessages',['$kelas_id'=>'kelas_id','$id_pertemuan'=>'id_pertemuan']);
          Route::post('/chat/{kelas_id}/{id_pertemuan}','AnggotaKelasController@storeMessages',['$kelas_id'=>'kelas_id','$id_pertemuan'=>'id_pertemuan']);
          //serahkan tugas individu
          Route::post('serahkan/serahkan_tugas_individu','AnggotaKelasController@serahkan_tugas_individu')->name('serahkanTugasIndividu');
          
        });
    });
    // route kelola pertemuan
  
    

    Route::group(['prefix' => 'ujian'], function () {
        Route::get('/index','UjianController@indexUjian')->name('siswa.ujian.index');
        Route::get('/wait/{id}','UjianController@waitUjian')->name('waitUjian');

        Route::get('/finish/{id}','UjianController@finishUjian',['id'=> 'id'])->name('finishUjian');

    });


});

// ROUTE GURU  ------------------------------------------------------------------------------------------
Route::group(['prefix' => 'guru'], function () {
    // route kelola profil guru
    Route::group(['prefix' => 'profil'], function () {
        Route::get('/','GuruController@index')->name('guru.profil');
        Route::post('/store','GuruController@store')->name('guru.profil.store');
        Route::get('/edit','GuruController@edit')->name('guru.profil.edit');
        Route::patch('/update','GuruController@update')->name('guru.profil.update');
    });
    // route kelola kelas guru
    Route::group(['prefix' => 'kelas'], function () {
        Route::get('/index','KelasController@index')->name('guru.kelas');
        Route::get('/create','KelasController@create')->name('guru.kelas.create');
        Route::post('/store','KelasController@store')->name('guru.kelas.store');
        Route::get('/show/{id}','KelasController@show')->name('guru.kelas.show');

        // route kelola pertemuan
        Route::group(['prefix' => 'pertemuan'], function () {
            Route::get('/create/{id}','PertemuanController@create')->name('pertemuan.create');
            Route::post('/store','PertemuanController@store')->name('pertemuan.store');
            Route::get('/show/{kelas_id}/{id_pertemuan}','PertemuanController@show',['$kelas_id'=>'kelas_id','$id_pertemuan'=>'id_pertemuan'])->name('pertemuan.show');
            Route::get('/ruang/{kelas_id}/{id_pertemuan}','PertemuanController@ruang',['$kelas_id'=>'kelas_id','$id_pertemuan'=>'id_pertemuan'])->name('pertemuan.ruang');
            Route::get('/end/{id}','PertemuanController@end')->name('pertemuan.end');
            Route::get('guru/kelas/pertemuan/ruang/chat/{kelas_id}/{id_pertemuan}','PertemuanController@fetchPesan',['$kelas_id'=>'kelas_id','$id_pertemuan'=>'id_pertemuan']);           
        });
        
        Route::group(['prefix' => 'diskusi'],function(){
            Route::get('/start/{id}','KelompokController@startDiskusi')->name('guru.diskusi.start');
            Route::get('/ruang/{id}','KelompokController@ruangDiskusi')->name('guru.diskusi.ruang');
        });

        Route::group(['prefix' => 'kelompok'],function(){
            Route::get('/create/{id}','KelompokController@create')->name('kelompok.create');
            Route::post('/store','KelompokController@store')->name('kelompok.store');
            Route::get('/show/{id}','KelompokController@show')->name('kelompok.show');
        });
        Route::group(['prefix' => 'tugas'],function(){
            //Route::get('/create/{id}','TugasController@create',['$kelas_id' =>'kelas_id'])->name('tugas.create');
            Route::get('/create/{kelas_id}','TugasController@create', ['$kelas_id' =>'kelas_id'])->name('tugas.create'); //
            Route::post('create/tugas_store','TugasController@tugas_individu_master_store')->name('storeTugasIndividu');
            Route::post('create/tugaskelompok_store','TugasController@tugas_kelompok_master_store')->name('storeTugasKelompok');
            // Route::post('serahkan/serahkan_tugas','TugasController@tugas_individu_master_store')->name('storeTugasIndividu');
            Route::patch('/kumpul_tugas/tugas/serahkan', 'TugasController@serahkan_tugas_individu')->name('serahTugas');
            Route::patch('/updatetugas','TugasController@update_tugas_individu')->name('ubahTugas');

            

        });
    });
    // route kelola paketsoal
    Route::group(['prefix' => 'paketsoal'], function () {
        Route::get('/','QuestionController@index')->name('paketsoal.index');
        Route::get('/create','QuestionController@create')->name('guru.paketsoal.create');
        Route::post('/store','QuestionController@store')->name('guru.paketsoal.store');
        Route::get('/delete/{id}','QuestionController@deletePaketSoal')->name('guru.paketsoal.delete');
        Route::patch('/update','QuestionController@updatePaketSoal')->name('guru.paketsoal.update');

        // Buat Soal Satuan
        Route::get('/create_soal_satuan/{paket_soal_id}','QuestionController@create_soal_satuan', ['$paket_soal_id' =>'paket_soal_id'])->name('create_soal_satuan'); //
        Route::get('/create_soal_satuan/hapus/{paket_soal_id}/{soal_satuan_id}','QuestionController@delete_soal_satuan', ['$paket_soal_id' =>'paket_soal_id','$soal_satuan_id'=>'soal_satuan_id'])->name('deleteSoalSatuan');

        //Soal Essay
        Route::post('question_store/essay_store','QuestionController@essay_store')->name('storeSingleQuestionEssay');
        Route::patch('/create_soal_satuan/{paket_soal_id}/updateessay','QuestionController@update_soal_satuan_essay', ['$paket_soal_id' =>'paket_soal_id'])->name('updateSoalSatuan');

        // Soal Pilgan
        Route::post('question_store/pilgan_store','QuestionController@pilgan_store')->name('storeSingleQuestionPilgan');
        Route::patch('/create_soal_satuan/{paket_soal_id}/updatepil','QuestionController@update_soal_satuan_pilgan', ['$paket_soal_id' =>'paket_soal_id'])->name('updateSoalSatuanPil');

        //Download
        Route::get('/export-soal/{id}','DocumentController@exportSoal')->name('exportSoal');
        // Route::get('/export-jawaban/{id}','DocumentController@exportJawaban')->name('exportJawaban');
       });


    Route::group(['prefix' => 'ujian'], function(){
        Route::get('/','UjianController@index')->name('guru.ujian.index');
        Route::get('/create','UjianController@create')->name('guru.ujian.create');
        Route::post('/store','UjianController@store')->name('guru.ujian.store');
        Route::get('/show/{id}','UjianController@show')->name('guru.ujian.show');
        Route::get('/monitoring','UjianController@monitoring')->name('guru.ujian.monitoring');
        Route::get('/koreksi/{id}','UjianController@koreksi')->name('koreksi');
    });
});




// Route khusus untuk pertukaran data lewat ajax
Route::get('absensi/create','AnggotaKelasController@absensi_create');
Route::get('chat_pertemuan/send','ChatController@chat_pertemuan_send');
Route::get('pertemuan/start','PertemuanController@pertemuan_start');
Route::get('pertemuan/end','PertemuanController@pertemuan_end');

Route::get('pagination/fetch_data', 'UjianController@fetch_data');
Route::get('store/essay_jawab', 'UjianController@storeEssay');
Route::get('store/pilgan_jawab', 'UjianController@storePilgan');

Route::get('run/exam','UjianController@run_exam');
Route::get('stop/exam','UjianController@stop_exam');
Route::get('fullscreen/room/exam','UjianController@fullscreen_room');

Route::patch('/essay_jawab/score/update', 'UjianController@updateScoreEssay');


Route::get('index',function(){
    return view('index');
});

Route::get('/chat/{kelas_id}/{id_pertemuan}','PertemuanController@fetchMessages',['$kelas_id'=>'kelas_id','$id_pertemuan'=>'id_pertemuan'])->name('pertemuan.ruang.chat');
Route::post('/chat/{kelas_id}/{id_pertemuan}','PertemuanController@storeMessages',['$kelas_id'=>'kelas_id','$id_pertemuan'=>'id_pertemuan'])->name('pertemuan.ruang.chatPost');
