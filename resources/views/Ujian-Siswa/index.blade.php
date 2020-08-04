@extends('layouts.layout_siswa')
@section('title')
	<title>Ujian Saya</title>
@endsection
@section('content')
<div>
  {{ Breadcrumbs::render('siswa.ujian.index') }}
</div>
<div class="container-fluid">
    @if($peserta_ujian->count() != 0)
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong style="font-size:18px;">Ujian yang akan dikerjakan</strong>
                </div>
                <div class="card-body">
                    <div class="table-inside">
                        <table class="table table-striped table-sm">
                            <thead class="text-center"  style="background-color:#393A3C; color:white; font-weight:bold">
                                <tr>
                                    <th scope="col" style="width:50px">No</th>
                                    <th scope="col" >Nama Ujian </th>
                                    <th scope="col" >Waktu Mulai </th>
                                    <th scope="col" >Durasi </th>
                                    <th scope="col" >Keterangan </th>
                                    <th scope="col" style="width:100px">Detail </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0; ?>
                                @foreach ($peserta_ujian as $item)
                                <tr>
                                    <td scope="row" class="text-center"><?php  $i++;  echo $i; ?></td>
                                    <td > {{$item->ujian->nama_ujian}}</td>
                                    <td class="text-center">{{$item->ujian->waktu_mulai}} </td>
                                    <td class="text-center">{{$item->ujian->paket_soal->durasi}} </td>
                                    <td class="text-center">
                                        <?php
                                        if ($item->ujian->status == 0) {
                                            echo "ujian segera dimulai";
                                        } elseif ($item->ujian->status == 1) {
                                            echo "ujian sedang berlangsung";
                                        } elseif ($item->ujian->status == 2) {
                                            echo "ujian telah berakhir";
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center"><a href="{{route('waitUjian',$item->id)}}">
                                        <button type="button" class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit fa-sm"></i> Masuk
                                            </button> </a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection