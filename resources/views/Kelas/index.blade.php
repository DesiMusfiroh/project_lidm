@extends('layouts.layout_guru')

@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')
<main class="main">
    <div>
      {{ Breadcrumbs::render('guru.kelas') }}
    </div>

    <div class="container-fluid">
    <div class="alert alert-success pb-1 pt-2" role="alert">
    <h5><strong>Daftar Kelas</strong> </h5>
    </div>
    @if($kelas->count() != 0)
        <div class="row">
            @foreach ($kelas as $item)
            <div class="col-md-4">
            <div class="card mb-3 ">
                <div class="card-body">
                    <h5 class="card-title">{{$item->nama_kelas}}</h5>
                    <p class="card-text">{{$item->deskripsi}}</p>
                    <div class="text-right"><a href="{{route('guru.kelas.show',$item->id)}}" class="btn btn-info"><i class="metismenu-icon pe-7s-monitor mr-1"></i> Masuk</a></div>
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
