@extends('layouts.layout_siswa')

@section('title')
    <title>Semua Tugas Saya</title>
@endsection

@section('content')
<div class="main-card mb-3 card">
  Nama Kelas : {{$kelas->nama_kelas}}
  <div class="card-body"><h5 class="card-title">Table with hover</h5>
      <table class="mb-0 table table-hover">
          <thead>
          <tr>
              <th>#</th>
              <th>Nama Tugas</th>
              <th>Nilai</th>
              <th>File</th>
          </tr>
          </thead>
          <tbody>
          @foreach($kumpul_tugas_individu as $item)
          <tr>
              <th scope="row">{{$loop->iteration}}</th>
              <td>{{$item->tugas_individu->tugas_individu_master->nama_tugas}}</td>
              <td>{{number_format($item->nilai,0)}}</td>
              @if($item->tugas == null)
              <td> Belum mengumpul tugas</td>
              @else
              <td><a href="{{url('tugas/'.$item->tugas)}}"><button class="btn btn-info btn-sm"><i class="fa fa-download"></i></button></a></td>
              @endif
              
          </tr>
          @endforeach
          </tbody>
      </table>
  </div>
  </div>

@stop
