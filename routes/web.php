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
    });
    // route kelola pertemuan
    Route::group(['prefix' => 'pertemuan'], function () {
        Route::get('/show/{kelas_id}/{id_pertemuan}','AnggotaKelasController@showPertemuan',['$kelas_id'=>'kelas_id','$id_pertemuan'=>'id_pertemuan'])->name('pertemuanSiswa.show');
        Route::get('/ruang/{kelas_id}/{id_pertemuan}','AnggotaKelasController@ruangPertemuan',['$kelas_id'=>'kelas_id','$id_pertemuan'=>'id_pertemuan'])->name('pertemuanSiswa.ruang');
    });

    Route::group(['prefix' => 'ujian'], function () {
        Route::get('/index','UjianController@indexUjian')->name('siswa.ujian.index');
        Route::get('/wait/{id}','UjianController@waitUjian')->name('waitUjian');
        Route::get('/run/{id}','UjianController@runUjian',['id'=> 'id'])->name('runUjian');
        Route::get('/finish/{id}','UjianController@finishUjian',['id'=> 'id'])->name('finishUjian');
        Route::get('pagination/fetch_data', 'UjianController@fetch_data');
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

        });

        Route::group(['prefix' => 'kelompok'],function(){
            //route untuk buat kelompok master sekaligus kelompok (satuan) sama masukin anggotanya otomatis
            Route::post('/store','KelasController@storeKelompok')->name('storeKelompok');
        });
    });
    // route kelola paketsoal
    Route::group(['prefix' => 'paketsoal'], function () {
        Route::get('/','QuestionController@index')->name('paketsoal.index');
        Route::get('/create','QuestionController@create')->name('guru.paketsoal.create');
        Route::post('/store','QuestionController@store')->name('guru.paketsoal.store');
        Route::patch('/update','QuestionController@updatePaketSoal')->name('guru.paketsoal.update'); 
       
        // Buat Soal Satuan
        Route::get('/create_soal_satuan/{paket_soal_id}','QuestionController@create_soal_satuan', ['$paket_soal_id' =>'paket_soal_id'])->name('create_soal_satuan'); //
       
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
    });
});




// Route khusus untuk pertukaran data lewat ajax
Route::get('absensi/create','AnggotaKelasController@absensi_create');
Route::get('chat_pertemuan/send','ChatController@chat_pertemuan_send');
Route::get('pertemuan/start','PertemuanController@pertemuan_start');
Route::get('pertemuan/end','PertemuanController@pertemuan_end');
