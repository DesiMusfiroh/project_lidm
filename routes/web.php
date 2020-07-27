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
        });
    });
    // route kelola paketsoal
    Route::group(['prefix' => 'paketsoal'], function () {
        Route::get('/','QuestionController@index')->name('paketsoal.index');
        Route::get('/create','QuestionController@create')->name('guru.paketsoal.create');
        Route::post('/store','QuestionController@store')->name('guru.paketsoal.store');

    });

});
