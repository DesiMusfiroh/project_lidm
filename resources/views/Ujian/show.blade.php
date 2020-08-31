@extends('layouts.layout_guru')
@section('title','nama ujian')
@section('content')
<main class="main">
  <div>
    {{ Breadcrumbs::render('guru.ujian.show',$ujian) }}
  </div>
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                  <strong style="font-size: 18px;">{{$ujian->nama_ujian}}</strong>
                </div>

                <?php
                  $durasi_jam   =  date('H', strtotime($ujian->paket_soal->durasi));
                  $durasi_menit =  date('i', strtotime($ujian->paket_soal->durasi));
                ?>

                <div class="card-body">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-8">
                        <table>
                          <tr>
                            <td width="150px" id="td-paket-soal">Paket soal</td>
                            <td width="10px">:</td>
                            <th>{{$ujian->paket_soal->judul}}</th>
                          </tr>
                          <tr>
                            <td>Jumlah soal</td>
                            <td>:</td>
                            <th> sekian soal</th>
                          </tr>
                          <tr>
                            <td>Durasi</td>
                            <td>:</td>
                            <th> {{ $durasi_jam }} jam {{ $durasi_menit }} menit</th>
                          </tr>
                          <tr>
                            <td>Jadwal Ujian </td>
                            <td>:</td>
                            <th>{{date('d M Y',strtotime($ujian->waktu_mulai))}}</th>
                          </tr>
                        </table>
                      </div>

                      <div class="col-md-4 status-ujian">
                        <div class="alert alert-secondary alert-sm mt-0 pt-0 pb-0 text-center"><strong>Ujian telah berakhir !</strong></div>
                        <div class="row text-right">
                          <div class="col-sm-9 offset-md-3">
                          <a  href="{{route('exportRekap',$ujian->id)}}"  target="_blank">
                                <button type="button" class="btn btn-sm btn-success">
                                    <i class="fa fa-download" aria-hidden="true"></i> Download Rekap Nilai
                                </button>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="text-center"><h5><strong >Peserta Ujian</strong></h5></div>


                  <div class="table-inside">
                    <table class="table table-striped table-bordered table-sm">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th scope="col" style="width:50px">No.</th>
                                <th scope="col" >Nama Peserta</th>
                                <th scope="col" >Nilai</th>
                                <th scope="col" style="width:150px">&nbsp; Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                          @if($peserta_ujian->count() !=0)
                          @foreach($peserta_ujian as $item)
 
                            <tr>
                              <td class="text-center">{{$loop->iteration}}</td>
                              <td class="text-center">{{$item->anggota_kelas->siswa->nama_lengkap}}</td>
                              <td class="text-center">{{number_format($item->nilai,0)}}</td>
                              <td class="text-center">
                                  <a href="{{route('koreksi',$item->id)}}">
                                    @if ($item->nilai !== null)
                                    <button type="button" class="btn btn-info btn-sm" >
                                        <i class="fa-fa-eye"></i> Detail Hasil
                                    </button>
                                    @else
                                    <button type="button" class="btn btn-warning btn-sm" >
                                        <i class="fa-fa-eye"></i> Koreksi Jawaban
                                    </button>
                                    @endif
                                  </a>
                              </td>
                            </tr>
                          @endforeach
                          @else
                          <tr>
                            Belum ada peserta
                          </tr>
                          @endif

                        </tbody>
                    </table>
                  </div>


                </div>
            </div>
        </div>
    </div>
</div>
</main>
@stop
