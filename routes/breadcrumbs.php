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




 ?>
