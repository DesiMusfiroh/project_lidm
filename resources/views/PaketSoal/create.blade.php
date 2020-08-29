@extends('layouts.layout_guru')

@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')
<main class="main">
      <div>
        {{ Breadcrumbs::render('buat-paketsoal') }}
      </div>


<div class="col-md-12">
    @if(session('pesan'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('pesan')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card">
        <div class="card-header  pt-3 pb-2 text-center">
            <strong style="font-size: 18px;">Buat Paket Soal</strong>
        </div>
        <div class="card-body">
            <form action="{{route('guru.paketsoal.store')}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="container">
                <input type="hidden" name="user_id" value="{{ Auth::user()->guru->id }} ">
                <div class="form-row mb-0 mt-0 pt-0">
                    <div class="form-group col-md-9">
                        <label for="judul"><b> Judul  : </b></label>
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Nama paket soal" style="border-radius:10px;  box-shadow: 3px 0px 5px grey;">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="durasi"> <b> Durasi </b> </label>
                        <input type="time" class="form-control" id="durasi" name="durasi" style="border-radius:10px; box-shadow: 3px 0px 5px grey;">
                    </div>
                </div>
                <hr>

                <div class="text-right"> <button type="submit" class="btn btn-primary" style="box-shadow: 3px 2px 5px grey;">Save </button> </div>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
