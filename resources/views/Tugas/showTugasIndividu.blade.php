@extends('layouts.layout_guru')

@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')
<div class="main-card mb-3 card">
  Nama Tugas : {{$tugas_individu_master->nama_tugas}}
  <div class="card-body"><h5 class="card-title">Table with hover</h5>
      <table class="mb-0 table table-hover">
          <thead>
          <tr>
              <th>#</th>
              <th>Nama Siswa</th>
              <th>No. Induk</th>
              <th>Tugas</th>
              <th>Nilai</th>
          </tr>
          </thead>
          <tbody>
          @foreach($kumpul_tugas_individu as $item)
          <tr>
              <th scope="row">{{$loop->iteration}}</th>
              <td>{{$item->anggota_kelas->siswa->nama_lengkap}}</td>
              <td>{{$item->anggota_kelas->siswa->nomor_induk}}</td>
              @if($item->tugas == null)
              <td> Belum mengumpul tugas</td>
              @else
              <td><a href="{{url('tugas/'.$item->tugas)}}"><button class="btn btn-info btn-sm"><i class="fa fa-download"></i></button></a></td>
              @endif
              <td>{{number_format($item->nilai,0)}}</td>
          </tr>
          @endforeach
          </tbody>
      </table>
  </div>
  </div>

@stop
