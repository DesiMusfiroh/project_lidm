@extends('layouts.layout_guru')

@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item"><a href="{{route('guru.kelas')}}">Kelas</a> </li>
        <li class="breadcrumb-item"><a href=""> A1TI - Kelas Teknologi Informasi </a></li>
        <li class="breadcrumb-item active">Buat KElompok</li>
    </ol>
    <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
            <div class="card-header">
                <div class="card-title">Buat Kelompok </div>
            </div>
            <form class="" action="{{route('kelompok.store')}}" method="post">
                @csrf
                <div class="card-body">        
                    <input type="hidden" name="kelas_id" value="{{$kelas_id}}">
                    <div class="position-relative form-group">
                        <label for="jumlah_kelompok" class="">Jumlah Kelompok</label>
                        <input name="jumlah_kelompok" id="jumlah_kelompok" type="number" class="form-control">
                    </div>
                    <div class="position-relative form-group">
                        <label for="deskripsiKelompok" class="">Deskripsi Kelompok</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control"> </textarea>
                    </div>
            
                </div>
                <div class="card-footer">
                    <div class="mr-auto">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
    </div>
</main>
@endsection