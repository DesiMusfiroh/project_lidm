@extends('layouts.layout_guru')

@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')
<main class="main"> 
    <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item"><a href="{{route('guru.kelas')}}">Kelas</a> </li>
        <li class="breadcrumb-item"><a href=""> A1TI - Kelas Teknologi Informasi </a></li>
        <li class="breadcrumb-item active">Detail Kelompok</li>
    </ol>
    <div class="container-fluid">
    <div class="row">
        @foreach($kelompok as $kel)
            <div class="col-md-4">
                <div class="card" >
                    <div class="card-body">
                        <h5 class="card-title">{{$kel->nama_kelompok}}</h5>
                        <table class="mb-0 table table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($kel->anggota_kelompok as $item)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$item->anggota_kelas->siswa->nama_lengkap}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
    </div>
</main>
@endsection
