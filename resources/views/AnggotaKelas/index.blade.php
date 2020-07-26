
@extends('layouts.layout_siswa')

@section('title')
    <title>Unbreakable</title>
@endsection
@section('content')
<main class="main">
    <div class="">
        {{ Breadcrumbs::render('kelas') }}
    </div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" >
            <div class="card" >
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <strong style="font-size:18px"> Daftar Kelas </strong>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                @endif
                <div class="row">
                    <div class="col-md-4 ml-auto  text-right" style=" font-size:20px; font-family:segoe ui black; font-weight:bold;">
                    <form method="POST" action="{{ route('gabungKelas') }}">
                    @csrf
                        <div class="input-group">
                        <input type="kode_kelas" id="kode_kelas" name="kode_kelas" required
                        placeholder="Masukkan Kode Kelas" class="form-control">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary"><i class="fa fa-plus"></i>  Gabung</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                    <br/><hr/>
                    @if($anggotaKelas->count() != 0)
                    <div class="row">
                        @foreach ($anggotaKelas as $item)
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$item->kelas->nama_kelas}}</h5>
                                        <p class="card-text">{{$item->kelas->deskripsi}}</p>
                                            <a href="{{route('siswa.kelas.show',$item->kelas->id)}}" class="btn btn-primary">Masuk</a>
                                    </div>
                                </div>
                             </div>
                        </div>
                    </div>
                        @endforeach
                    @else
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong> Anda belum tergabung dalam kelas manapun. Silahkan gabung kedalam kelas!</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
