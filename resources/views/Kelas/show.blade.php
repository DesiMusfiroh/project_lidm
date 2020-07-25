@extends('layouts.layout_guru')

@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb bg-dark">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{route('guru.kelas')}}">Kelas</a> </li>
        <li class="breadcrumb-item active">{{$kelas->nama_kelas}}</li>
    </ol>
    <div class="container-fluid">

        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">{{$kelas->nama_kelas}}</h4>
            <p>{{$kelas->deskripsi}}</p>
            <hr>
            <div class="mb-0 text-right">
                Kode Akses Kelas : <strong>{{$kelas->kode_kelas}}</strong>
            </div>
        </div>
        <div class="card pt-3 pr-3 pl-3">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="#">Daftar Siswa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pertemuan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Kelompok</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tugas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Hasil Ujian</a>
                </li>
            </ul>
        </div>
    </div>
</main>
@endsection