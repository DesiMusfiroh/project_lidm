@extends('layouts.layout_guru')
@section('title','Ujian')
@section('content')


<div class="container">
  <div>
    {{ Breadcrumbs::render('guru.ujian.index') }}
  </div>
    <div class="row justify-content-center">
        <div class="col-md-12" >
            <div class="card">
                <div class="card-header">
                  <strong style="font-size:18px"> Riwayat Ujian </strong>
                </div>

                <div class="card-body pb-0">

                @if($ujian->count() != 0)
                <div class="table-inside">
                    <table class="table table-striped table-bordered table-sm">
                        <thead class="text-center bg-dark" style="color:white;">
                          <tr>
                            <th style="width:50px">No</th>
                            <th>Nama Ujian</th>
                            <th>Kelas</th>
                            <th>Paket Soal</th>
                            <th>Waktu Mulai</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody class="text-center">
                        @foreach($ujian as $item)
                        <tr>
                          <th scope="row" class="text-center">{{$loop->iteration}}</th>
                          <td>{{$item->nama_ujian}}</td>
                          <td>{{$item->kelas->nama_kelas}}</td>
                          <td>{{$item->paket_soal->judul}}</td>
                          <td>{{$item->waktu_mulai}}</td>
                          <td> <a href="{{route('guru.ujian.show',$item->id)}}" class="btn btn-sm btn-info" title="Lihat"> <i class="fa fa-eye"></i> </a> </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
                <div class=" row justify-content-right"> <div class="col-md-12"> {{$ujian->links()}}</div></div>
                @else
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong> Belum ada ujian yang di buat. Silahkan buat ujian baru!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>


@stop
