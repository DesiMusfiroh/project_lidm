@extends('layouts.layout_guru')
@section('title','Ujian')
@section('content')
  <a href="{{route('guru.ujian.create')}}"><button type="button" class="btn btn-primary" name="button" >Buat Ujian</button></a>
  <div class="main-card mb-3 card">
    <div class="row">
      <div class="card-body"><h5 class="card-title">Table with hover</h5>
        <table class="mb-0 table table-hover">
          <thead>
            <tr>
              <th>No</th>
              <th>Kelas</th>
              <th>Paket Soal</th>
              <th>Waktu Mulai</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($ujian as $item)
            <tr>
              <th scope="row">{{$loop->iteration}}</th>
              <td>{{$item->kelas->nama_kelas}}</td>
              <td>{{$item->paket_soal->judul}}</td>
              <td>{{$item->waktu_mulai}}</td>
              <td> <a href="{{route('guru.ujian.show',$item->id)}}" class="btn btn-info" title="Lihat"> <i class="fa fa-eye"></i> </a> </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@stop
