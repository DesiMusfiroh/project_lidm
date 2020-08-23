@extends('layouts.layout_guru')

@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item"><a href="{{route('guru.kelas')}}">Kelas</a> </li>
        <li class="breadcrumb-item"><a href=""> A1TI - Kelas Teknologi Informasi </a></li>
        <li class="breadcrumb-item active">Buat Tugas</li>
    </ol>
    <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
            <div class="card-header">
                <div class="card-title">Buat Tugas </div>
            </div>
            <form class="" action="{{route('tugas.store')}}" method="post">
                @csrf
                <div class="card-body">  
                    <div class="row">
                        <div class="col-md-2">
                            <button class="btn btn-secondary mb-3">Tugas Individu</button>
                            <button class="btn btn-primary">Tugas Kelompok</button>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">Nama Tugas</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_tugas">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">Pertemuan</label>
                                <div class="col-sm-10">
                                <select class="form-control" name="paketsoal">
                                    <option disabled selected>Pilih Pertemuan</option>
                                    @foreach($pertemuan as $item)
                                    <option value="{{$item->id}}">{{$item->nama_pertemuan}}</option>
                                    @endforeach

                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">Deadline</label>
                                <div class="col-md-10">
                                <input type="datetime-local"  class="form-control" name="waktu_mulai" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"> Deskripsi</label>
                                <div class="col-sm-10">
                                <textarea class="form-control" rows="3" name="deskripsi"></textarea>
                                </div>
                            </div>     
                            <input type="hidden" name="kelas_id" value="{{$kelas_id}}">            
                            <input type="hidden" name="status" value="0"> 
                        </div>
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
