@extends('layouts.layout_guru')

@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb bg-dark">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Kelas</li>
    </ol>
    <div class="container-fluid">
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
    @endif
    </div>
</main>
@endsection
