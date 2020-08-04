@extends('layouts.layout_siswa')
@section('content')
<style>
@media screen and (max-width: 1000px) {
   .card-img{
     max-width: 50px;
     max-height: 45px;
   }

   .namauser,.tekskecil{
     font-size: 10px;
     margin-top: 0px;
   }

   #card-peserta{
     display: flex;
     justify-content: center;

   }
}
</style>
<div class="container">
<div class="card ">

    <div class="card-header" > 
        <strong style="font-size:18px">Hasil Ujian Peserta</strong>
        <!-- <div class="row">
            <div class="col-md-9"></div>
            <div class="col-md-3 text-right">
            @if($peserta_ujian->nilai != null )
                <a  href="{{route('hasil_pdf',$peserta->id)}}"  target="_blank">
                    <button type="button" class="btn btn-info">
                    <i class="fa fa-download" aria-hidden="true"></i> Download PDF
                    </button>
                </a>
            @endif
            </div>
        </div> -->

    </div>

    <div class="card-body text-center">
      @if ($peserta_ujian->nilai !== null)
        <div id="hasil">
            @if ($peserta_ujian->nilai !== null)
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <div class="alert alert-success" role="alert">
                            Total Score : {{$peserta_ujian->nilai}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="alert alert-success" role="alert">
                            Total Poin : {{$total_poin}}
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="alert alert-success" role="alert">
                            Nilai Akhir : {{$nilai_akhir}}
                        </div>
                    </div>
                </div>
                @endif
            @if ($pilgan_jawab->count() != 0)
            <h5> <strong>Hasil Ujian Pilihan Ganda Peserta</strong> </h5>
            <div class="table-inside">
            <table class="table table-striped table-bordered table-sm">
                <thead class="thead-dark text-center">
                    <tr>
                        <th scope="col" style="width:50px">No</th>
                        <th scope="col" style="width:400px">Jawaban Peserta</th>
                        <th scope="col" style="width:150px">Kunci Jawaban</th>
                        <th scope="col" style="width:150px">Keterangan</th>
                        <th scope="col" style="width:140px">score</th>

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
            </div>
            @endif

            @if ($essay_jawab->count() != 0)
            <h5> <strong> Hasil Ujian Essay Peserta</strong></h5>
            <div class="table-inside">
            <table class="table table-striped table-bordered table-sm">
                <thead class="thead-dark text-center">
                    <tr>
                        <th scope="col" style="width:50px">No</th>
                        <th scope="col" style="width:400px">Pertanyaan</th>
                        <th scope="col" style="width:150px">Jawaban Peserta</th>
                        <th scope="col" style="width:150px">Poin Soal</th>
                        <th scope="col" style="width:140px">score</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i=0; ?>
                    @foreach ($essay_jawab as $item)
                    <tr>
                        <td scope="row"><?php  $i++;  echo $i; ?></td>
                        <td>{!!$item->essay->pertanyaan!!}</td>
                        <td>{{$item->jawab}}</td>
                        <td>{!!$item->essay->soal_satuan->poin!!}</td>
                        <td>{{$item->score}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            @endif
        </div>
      @else
      <script>
        $(document).ready(function(){
          // Swal.fire({
          //   title: "Yakin?",
          //   text: "Soal sedang dikoreksi",
          //   icon: "warning",
          //   buttons: true,
          //   dangerMode: false,
          // })
          swal({
            title: "Soal sedang dikoreksi",
            text: "Anda dapat melihat hasil ujian setelah dikoreksi",
            icon: "warning",
            button: "Oke",
          });
          //swal("soal sedang dikoreksi");
        });
        // Swal.fire('Soal sedang dikoreksi');
      </script>
      <strong>Menunggu di koreksi </strong>
      @endif
    </div>
</div>
</div>
@endsection
