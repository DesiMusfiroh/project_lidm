@extends('layouts.layout_guru')
@section('title','Buat Ujian')
@section('content')
<div>
  {{ Breadcrumbs::render('guru.ujian.create') }}
</div>
<div class="container ">
<div class="row justify-content-center">
<div class="col-md-10">
  <div class="card ">
      <div class="card-header">
          <strong style="font-size: 18px;">Buat Ujian</strong>
      </div>
      <div class="card-body">

          <div class="container ">

            <form class="" action="{{route('guru.ujian.store')}}" method="post" class="form-control">
              @csrf
              <div class="row mt-2  mr-3">
                <div class="col-md-3 offset-md-1">
                  <label for=""> <strong>Pilih Kelas</strong> </label>
                </div>
                <div class="col-md-8 input-waktu">
                  <select class="form-control" name="kelas">
                    <option disabled selected>Pilih ...</option>
                    @foreach($kelas as $item)
                    <option value="{{$item->id}}">{{$item->nama_kelas}}</option>
                    @endforeach

                  </select>
                </div>
              </div>
              <div class="row mt-2  mr-3">
                <div class="col-md-3 offset-md-1">
                  <label for=""> <strong>Pilih Paket Soal</strong> </label>
                </div>
                <div class="col-md-8 input-waktu">
                  <select class="form-control" name="paketsoal">
                    <option disabled selected>Pilih ...</option>
                    @foreach($paketsoal as $item)
                    <option value="{{$item->id}}">{{$item->judul}}</option>
                    @endforeach

                  </select>
                </div>
              </div>
              <div class="row mt-2 mr-3">
                <div class="col-md-3 offset-md-1">
                  <label for=""> <strong> Nama Ujian</strong></label>
                </div>
                <div class="col-md-8 input-data">
                  <input type="text" name="nama_ujian" value="" class="form-control" placeholder="nama ujian">
                </div>
              </div>
              <div class="row mt-2 mb-2  mr-3">
                <div class="col-md-3 offset-md-1">
                  <label for=""> <strong>Waktu Mulai</strong> </label>
                </div>
                <div class="col-md-8 input-waktu">
                  <input type="datetime-local"  class="form-control" name="waktu_mulai" value="" id="jam">
                </div>
              </div>
              <hr>
              <div class="row mt-2 offset-md-9">
                <div class="text-right col-md-10"> <button type="submit" class="btn btn-primary" style="box-shadow: 3px 2px 5px grey;"> Simpan </button> </div>
              </div>
            </form>
          </div>

      </div>
  </div>
</div>
</div>
</div>
@stop
