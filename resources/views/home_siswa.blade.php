@extends('layouts.layout_siswa')

@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')

<main class="main">
    <div>
      {{ Breadcrumbs::render('home') }}
    </div>
@if($peserta_ujian->count() != 0)
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"  style="border-radius:20px 20px 0px 0px; ">
                <strong style="font-size:18px;">Ujian yang akan dikerjakan</strong>
            </div>
            <div class="card-body">
                <div class="table-inside">
                    <table class="table table-striped table-bordered table-sm">
                        <thead class="thead-dark text-center">
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
                                <td >{{$item->ujian->nama_ujian}}</td>
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
                                        // $waktu_sekarang = date('Y-m-d H:i:s');
                                        // $waktu_mulai    =$item->ujian->waktu_mulai;
                                        // $durasi = $item->ujian->paket_soal->durasi;

                                        // $durasi_jam   =  date('H', strtotime($durasi));
                                        // $durasi_menit =  date('i', strtotime($durasi));
                                        // $durasi_detik =  date('s', strtotime($durasi));

                                        // $selesai = date_create($waktu_mulai);
                                        // date_add($selesai, date_interval_create_from_date_string("$durasi_jam hours, $durasi_menit minutes, $durasi_detik seconds"));
                                        // $waktu_selesai  = date_format($selesai, 'Y-m-d H:i:s');

                                        // if (strtotime($waktu_sekarang) < strtotime($waktu_mulai)) {
                                        //     echo "segera dimulai";
                                        // }
                                        // elseif (strtotime($waktu_sekarang) > strtotime($waktu_selesai)) {
                                        //     echo "ujian telah berakhir";
                                        // }
                                        // elseif (strtotime($waktu_sekarang) >= strtotime($waktu_mulai) && strtotime($waktu_sekarang) <= strtotime($waktu_selesai)) {
                                        //     echo "ujian sedang berlangsung";
                                        // }
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
    <div class="animated fadeIn">
    </div>
</main>
@endsection
