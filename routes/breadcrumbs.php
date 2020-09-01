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
Breadcrumbs::register('siswa.kelas.show', function ($breadcrumbs, $kelas) {
    $breadcrumbs->parent('kelas');
    $breadcrumbs->push($kelas->nama_kelas, route('siswa.kelas.show', $kelas->id));
});
Breadcrumbs::register('pertemuanSiswa.show', function ($breadcrumbs, $kelas, $pertemuan) {
    $breadcrumbs->parent('siswa.kelas.show',$kelas);
    $breadcrumbs->push($pertemuan->nama_pertemuan, url('siswa/kelas/pertemuan/show/{kelas_id}/{id_pertemuan}'));
});

Breadcrumbs::register('kelompokSaya.show', function ($breadcrumbs, $kelas, $kelompok_saya_ikuti) {
    $breadcrumbs->parent('siswa.kelas.show',$kelas);
    $breadcrumbs->push($kelompok_saya_ikuti->nama_kelompok, route('kelompokSaya.show',$kelompok_saya_ikuti->id));
});

//Siswa Ujian
Breadcrumbs::register('siswa.ujian.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Ujian', route('siswa.ujian.index'));
});
Breadcrumbs::register('waitUjian', function ($breadcrumbs,$ujian) {
    $breadcrumbs->parent('siswa.ujian.index');
    $breadcrumbs->push($ujian->nama_ujian, route('waitUjian',$ujian->id));
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
Breadcrumbs::register('create_soal_satuan', function ($breadcrumbs, $paket_soal) {
    $breadcrumbs->parent('paketsoal.index');
    $breadcrumbs->push($paket_soal->judul, route('create_soal_satuan',$paket_soal->id));
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
Breadcrumbs::register('kelompok.show', function ($breadcrumbs, $kelas, $kelompok_master) {
    $breadcrumbs->parent('guru.kelas.show',$kelas);
    $breadcrumbs->push($kelompok_master->deskripsi, route('kelompok.show',$kelompok_master->id));
});
Breadcrumbs::register('showTugasIndividu', function ($breadcrumbs, $kelas,$tugas_individu_master) {
    $breadcrumbs->parent('guru.kelas.show',$kelas);
    $breadcrumbs->push($tugas_individu_master->nama_tugas, route('showTugasIndividu', $tugas_individu_master->id));
});
Breadcrumbs::register('showTugasKelompok', function ($breadcrumbs, $kelas,$tugas_kelompok_master) {
    $breadcrumbs->parent('guru.kelas.show',$kelas);
    $breadcrumbs->push($tugas_kelompok_master->nama_tugas, route('showTugasKelompok', $tugas_kelompok_master->id));
});

Breadcrumbs::register('tugas.create', function ($breadcrumbs, $kelas) {
    $breadcrumbs->parent('guru.kelas.show',$kelas);
    $breadcrumbs->push("Buat Tugas", route('tugas.create', $kelas->id));
});



Breadcrumbs::register('kelompok.create', function ($breadcrumbs, $kelas) {
    $breadcrumbs->parent('guru.kelas.show',$kelas);
    $breadcrumbs->push("Buat kelompok", route('kelompok.create', $kelas->id));
});


Breadcrumbs::register('guru.ujian.create', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Buat Ujian', route('guru.ujian.create'));
});
Breadcrumbs::register('guru.ujian.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Daftar Riwayat Ujian', route('guru.ujian.index'));
});
Breadcrumbs::register('guru.ujian.show', function ($breadcrumbs,$ujian) {
    $breadcrumbs->parent('guru.ujian.index');
    $breadcrumbs->push($ujian->nama_ujian, route('guru.ujian.show',$ujian->id));
});
Breadcrumbs::register('koreksi', function ($breadcrumbs,$ujian,$peserta_ujian) {
    $breadcrumbs->parent('guru.ujian.show',$ujian);
    $breadcrumbs->push('Koreksi Ujian', route('koreksi',$peserta_ujian->id));
});
Breadcrumbs::register('guru.ujian.monitoring', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Monitoring Ujian', route('guru.ujian.monitoring'));
});


 ?>
