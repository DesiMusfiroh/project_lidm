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
Route::get('profil/guru','GuruController@index');
