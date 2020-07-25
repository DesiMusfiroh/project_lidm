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

// ROUTE PROFIL SISWA -----------------------------------------------------------------------------------------
Route::get('profil/siswa','SiswaController@index');
// ROUTE PROFIL GURU -----------------------------------------------------------------------------------------
// Route::get('profil/guru','GuruController@index');


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
    });
});