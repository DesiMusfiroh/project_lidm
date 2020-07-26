@extends('layouts.layout_guru')

@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item active">Kelas</li>
    </ol>

    <div class="container-fluid">
    <div class="alert alert-info" role="alert">
    <h4> Daftar Kelas</h4>
    </div>
    @if($kelas->count() != 0)
        <div class="row">
            @foreach ($kelas as $item)
            <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{$item->nama_kelas}}</h5>
                    <p class="card-text">{{$item->deskripsi}}</p>
                    <a href="{{route('guru.kelas.show',$item->id)}}" class="btn btn-primary">Masuk</a>
                </div>
            </div>
            </div>
            @endforeach
        </div>
    @else
    <div class="col-md-12">
        <div class="alert alert-warning" role="alert">
            Belum ada kelas yang dibuat
        </div>
    </div> 
    @endif
    </div>
</main>
@endsection
