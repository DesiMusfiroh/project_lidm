@extends('layouts.layout_guru')

@section('content')
<main>
<div>
{{ Breadcrumbs::render('koreksi',$peserta_ujian->ujian,$peserta_ujian) }}
</div>

<div class="container">
    @if(session('sukses'))
        <div class="alert alert-success" role="alert">
            {{session('sukses')}}
        </div>
    @endif
    <div class="row "> 
        <div class="col-md-8">
            <div class="card text-center  pt-3 pr-3 pl-3 pb-3">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="koreksi-tab" data-toggle="tab" href="#koreksi" role="tab" aria-controls="koreksi" aria-selected="true">Koreksi Jawaban</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="hasil-tab" data-toggle="tab" href="#hasil" role="tab" aria-controls="hasil" aria-selected="false">Hasil Ujian</a>
                    </li>
                </ul>

                <div class="tab-content mr-3 ml-3">
                    
                    <div class="tab-pane active" id="koreksi" role="tabpanel" aria-labelledby="koreksi-tab">
                        <div id="koreksi">
                        @if($koreksi_jawaban->count() != 0)

                            @foreach ($koreksi_jawaban as $item)
                            <div class="alert alert-success text-left" role="alert">
                                Pertanyaan : {!!$item->essay->pertanyaan!!} 
                                kunci jawaban : {!!$item->essay->jawaban!!} 
                                Jawaban Peserta : {{$item->jawab}}
                                <hr>
                                <div class="row">
                                    <div class="col-md-8 text-left"></div>
                                    <div class="col-md-4 ">
                                        <form action="/essay_jawab/score/update" method="post">
                                        @csrf
                                        @method('PATCH')
                                            <input type="hidden" name="id" id="id" value="{{$item->id}}">
                                            <div class="input-group">
                                            <input type="number" name="score" class="form-control" placeholder="Score" aria-label="score" aria-describedby="button-addon2" max="{{$item->essay->soal_satuan->poin}}">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="submit" id="simpan">Simpan</button>
                                            </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong> Tidak ada jawaban peserta yang perlu di koreksi </strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        </div>
                    </div>
                    <div class="tab-pane " id="hasil" role="tabpanel" aria-labelledby="hasil-tab">
                        <div id="hasil">
                            @if ($peserta_ujian->nilai !== null)
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <div class="alert alert-success pt-1 pb-1" role="alert">
                                        Total Score : {{$peserta_ujian->nilai}}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="alert alert-success pt-1 pb-1" role="alert">
                                        Total Poin :  
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="alert alert-success pt-1 pb-1" role="alert">
                                        Nilai Akhir : 
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if ($pilgan_jawab->count() != 0)
                            <h5> <strong>Hasil Ujian Pilihan Ganda Peserta</strong> </h5>
                            <table class="table table-striped table-bordered table-sm">
                                <thead class="thead-dark text-center">
                                    <tr>
                                        <th scope="col" style="width:50px">No</th>
                                        <th scope="col" style="width:400px">Jawaban Peserta</th>
                                        <th scope="col" style="width:150px">Kunci Jawaban</th>
                                        <th scope="col" style="width:150px">Keterangan</th>
                                        <th scope="col" style="width:140px">Score</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0; ?>
                                    @foreach ($pilgan_jawab as $item)
                                    <tr>
                                        <td scope="row"><?php  $i++;  echo $i; ?></td>
                                        <td>{{$item->jawab}}</td>
                                        <td>{{$item->pilgan->kunci}}</td>
                                        <td>@if ($item->status == 'T') Benar @else Salah @endif</td>
                                        <td>{{$item->score}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif

                            @if ($essay_jawab->count() != 0)
                            <h5> <strong> Hasil Ujian Essay Peserta</strong></h5>
                            <table class="table table-striped table-bordered table-sm">
                                <thead class="thead-dark text-center">
                                    <tr>
                                        <th scope="col" style="width:50px">No</th>
                                        <th scope="col" style="width:400px">Pertanyaan</th>
                                        <th scope="col" style="width:150px">Jawaban Peserta</th>
                                        <th scope="col" style="width:150px">Poin Soal</th>
                                        <th scope="col" style="width:140px">Score</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0; ?>
                                    @foreach ($essay_jawab as $item)
                                    <tr>
                                        <td scope="row"><?php  $i++;  echo $i; ?></td>
                                        <td>{!!$item->essay->pertanyaan!!}</td>
                                        <td>{!!$item->jawab!!}</td>
                                        <td>{!!$item->essay->soal_satuan->poin!!}</td>
                                        <td>{{$item->score}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>
                </div>
            
                </div>
        </div>

        <div class="col-md-4">
            <div class="card text-right" >
                <div class="card-header"><div class="card-title">{{$peserta_ujian->anggota_kelas->siswa->nama_lengkap}}</div> </div>
                <div class="card-body">
                    <h5 class="card-title">{{$peserta_ujian->ujian->nama_ujian}}</h5>
                    <p class="card-text">Paket Soal {{$peserta_ujian->ujian->paket_soal->judul}}</p>
                </div>
            </div>
        </div>
    </div>

    

</div>
</main>
<script>
  $(function () {
    $('#myTab li:last-child a').tab('show')
  })
</script>
@endsection