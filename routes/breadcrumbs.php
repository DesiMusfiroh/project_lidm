<?php
Breadcrumbs::register('home', function ($breadcrumbs) {
     $breadcrumbs->push('Home', route('home'));
});


//Siswa Profil
Breadcrumbs::register('profil', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Profil', route('siswa.profil'));
});
Breadcrumbs::register('edit', function ($breadcrumbs) {
    $breadcrumbs->parent('profil');
    $breadcrumbs->push('Edit', route('siswa.profil.edit'));
});


//Siswa kelas
Breadcrumbs::register('kelas', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Kelas', route('siswa.kelas'));
});
Breadcrumbs::register('showkelas', function ($breadcrumbs, $kelas) {
    $breadcrumbs->parent('kelas');
    $breadcrumbs->push($kelas->nama_kelas, route('siswa.kelas.show', $kelas->id));
});



//Untuk guru -------------------------------------------------------------------------------------
Breadcrumbs::register('guru.profil', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Profil', route('guru.profil'));
});

Breadcrumbs::register('guru.profil.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('guru.profil');
    $breadcrumbs->push('Edit', route('guru.profil.edit'));
});

Breadcrumbs::register('buat-paketsoal', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Buat paket soal', route('guru.paketsoal.create'));
});
Breadcrumbs::register('paketsoal.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Paket Soal', route('paketsoal.index'));
});


Breadcrumbs::register('guru.kelas.create', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Buat kelas baru', route('guru.kelas.create'));
});
Breadcrumbs::register('guru.kelas', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Kelas', route('guru.kelas'));
});
Breadcrumbs::register('guru.kelas.show', function ($breadcrumbs, $kelas) {
    $breadcrumbs->parent('guru.kelas');
    $breadcrumbs->push($kelas->nama_kelas, route('guru.kelas.show', $kelas->id));
});
Breadcrumbs::register('pertemuan.show', function ($breadcrumbs, $kelas, $pertemuan) {
    $breadcrumbs->parent('guru.kelas.show',$kelas);
    $breadcrumbs->push($pertemuan->nama_pertemuan, url('guru/kelas/pertemuan/show/{kelas_id}/{id_pertemuan}'));
});



 ?>
