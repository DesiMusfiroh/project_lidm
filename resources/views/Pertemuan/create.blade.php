@extends('layouts.layout_guru')

@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item"><a href="{{route('guru.kelas')}}">Kelas</a> </li>
        <li class="breadcrumb-item"><a href="{{route('guru.kelas.show',$kelas->id)}}"> {{$kelas->nama_kelas}} </a></li>
        <li class="breadcrumb-item active">Buat Pertemuan</li>
    </ol>
    <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
            <div class="card-header">
                <div class="card-title">Buat Pertemuan Baru</div>
            </div>
            <form action="{{route('pertemuan.store')}}"  method="post" enctype="multipart/form-data" >
            @csrf
            <div class="card-body">        
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Nama Pertemuan</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_pertemuan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Waktu Mulai</label>
                        <div class="col-md-10">
                        <input type="datetime-local"  class="form-control" name="waktu_mulai" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"> Keterangan</label>
                        <div class="col-sm-10">
                        <textarea class="form-control" rows="3" name="deskripsi"></textarea>
                        </div>
                    </div>     
                    <input type="hidden" name="kelas_id" value="{{$kelas->id}}">            
                    <input type="hidden" name="status" value="0">            
            </div>
            <div class="card-footer">
                <div class="mr-auto">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
    </div>
</main>
@endsection
