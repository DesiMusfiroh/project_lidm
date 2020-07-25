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
        Route::get('/index','SiswaController@index')->name('siswa.profil');
        Route::post('/store','SiswaController@store')->name('siswa.profil.store');
        Route::get('/edit','SiswaController@edit')->name('siswa.profil.edit');
        Route::patch('/update','SiswaController@update')->name('siswa.profil.update');
    });
    // route kelola kelas siswa
    Route::group(['prefix' => 'kelas'], function () {
        Route::get('/index','AnggotaKelasController@index')->name('siswa.kelas');
        Route::post('/gabungkelas','AnggotaKelasController@gabungKelas')->name('gabungKelas');
    });
});

// ROUTE GURU  ------------------------------------------------------------------------------------------
Route::group(['prefix' => 'guru'], function () {
    // route kelola profil guru
    Route::group(['prefix' => 'profil'], function () {
        Route::get('/index','GuruController@index')->name('guru.profil');
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
    });
});