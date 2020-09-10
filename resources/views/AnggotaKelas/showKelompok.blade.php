@extends('layouts.layout_siswa')

@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')
<main class="main">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <strong style="font-size:18px"> DAFTAR KELOMPOK </strong>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                      <div class="col-md-6">
                        <div class="row mb-3">
                          <div class="col-md-6 text-left">
                            <span>Nama Kelompok</span>
                          </div>
                          <div class="col-md-6 text-left">
                            {{$kelompok_saya->nama_kelompok}}
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-md-6 text-left">
                            <span>Deskripsi</span>
                          </div>
                          <div class="col-md-6 text-left">
                            {{$kelompok_saya->kelompok_master->deskripsi}}
                          </div>
                        </div>
                      </div>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                        <table class="mb-0 table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Siswa</th>
                                <th>No. Induk</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($kelompok_saya->anggota_kelompok as $item)
                            <tr>
                                <td scope="row">{{$loop->iteration}}</th>
                                <td>{{$item->anggota_kelas->siswa->nama_lengkap}}</td>
                                <td>{{$item->anggota_kelas->siswa->nomor_induk}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

  </div>

  </div>
</main>
@stop
