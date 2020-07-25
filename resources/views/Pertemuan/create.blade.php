@extends('layouts.layout_guru')

@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item">Kelas</li>
        <li class="breadcrumb-item">{{$kelas->nama_kelas}}</li>
        <li class="breadcrumb-item active">Buat Pertemuan</li>
    </ol>
</main>
@endsection
