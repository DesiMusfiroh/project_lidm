@extends('layouts.layout_guru')

@section('title')
    <title>Unbreakable</title>
@endsection
@section('content')
<style>

@media screen and (max-width: 1000px) {
  video{
    width: 200px;
    height: 170px;
    margin-top: 5px;
    margin-right: 5px;
  }
}
:fullscreen {
  background-color:black;
}

</style>

<div>
  {{ Breadcrumbs::render('guru.ujian.monitoring') }}
</div>
<div class="container">
    @if($ujian_run->count() != 0)
    <div class="row justify-content-center">
        @foreach ($ujian_run as $item)
        <div class="col-sm-4">
            <div class="card text-center mb-4">
                <div class="card-header justify-content-center" ><strong style="color:black">{{$item->nama_ujian}}</strong></div>
                <div class="card-body">

                    <p class="card-text">
                        Waktu Mulai : {{date("d-m-Y H:i:s",strtotime($item->waktu_mulai))}} <br>
                        <?php   $durasi_jam   =  date('H', strtotime($item->paket_soal->durasi));
                                $durasi_menit =  date('i', strtotime($item->paket_soal->durasi)); ?>
                        Durasi : {{ $durasi_jam }} jam {{ $durasi_menit }} menit
                    </p>
                    <!-- <input type="text" class="ujian_id"  value="{{$item->id}}" > -->
                    <a href="{{route('guru.ujian.monitoring.room',$item->id)}}"> <button  type="submit" id="{{$item->id}}" class="btn btn-info btn-sm monitoring" data-ujian_id="{{$item->id}}">
                        <i class="fa fa-laptop fa-sm"></i> Monitoring Ujian
                    </button> </a>

                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong> Tidak ada ujian yang perlu di awasi</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

<hr>

    @if($ujian_aktif->count() != 0)
    <div class="text-center alert alert-warning"> <strong style="font-size:18px">Ujian yang akan datang</strong></div>
    <div class="row">
        @foreach ($ujian_aktif as $item)
        <div class="col-sm-4">
            <div class="card text-center mb-4">
            <div class="card-body">
                <strong  style="color:black">{{$item->nama_ujian}}</strong>
                <p class="card-text">
                    Waktu Mulai : {{date("d-m-Y H:i:s",strtotime($item->waktu_mulai))}} <br>
                    <?php   $durasi_jam   =  date('H', strtotime($item->paket_soal->durasi));
                            $durasi_menit =  date('i', strtotime($item->paket_soal->durasi)); ?>
                    Durasi : {{ $durasi_jam }} jam {{ $durasi_menit }} menit
                </p>
            </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

</div>

<script>

// menghitung timer
setInterval(myTimer, 1000);
function myTimer() {
    var d               = new Date();
    var tanggal         = d.toISOString().split('T')[0];
    var time            = new Date().toString('hh:mm:tt');
    var time_string     = time.substr(16,8);
    var waktu_sekarang  = tanggal + ' ' + time_string;

    var ujian = <?php echo $tabel ?>; // mengambil data object array ujian dari controller
    console.log(ujian);
    for (var key in ujian) {
        var waktu_ujian = (key, ujian[key][3]);
        var ujian_id = (ujian[key][0]);

        // perbandingan waktu mulai ujian dengan waktu sekarang
        if (waktu_ujian === waktu_sekarang) {
            console.log('mulai ujian');
            $(".tombol_monitoring").show();
            $.ajax({
                url: "{{ url('run/exam') }}",
                type: "GET",
                dataType: 'json',
                data: {
                    ujian_id: ujian_id
                },
                success: function(data) {
                    console.log(data);
                }
            });
        } else {
            console.log(waktu_ujian);
        }
        // ------------------------------------
    }
}

// hitung selisih waktu, jika sudah masuk waktu mulai maka status berubah jadi 1
var ujian_data = <?php echo $tabel ?>;
for (var key in ujian_data) {
    var start       = (key, ujian_data[key][5]);
    var finish      = (key, ujian_data[key][6]);
    var ujian_id    = (ujian_data[key][0]);

    const mulai     = new Date(start).getTime();
    const sekarang  = new Date().getTime();
    const selisih   = mulai - sekarang;

    if( selisih <= 0 ) {
        $.ajax({
            url: "{{ url('run/exam') }}",
            type: "GET",
            dataType: 'json',
            data: {
                ujian_id: ujian_id
            },
            success: function(data) {
                console.log(data);
            }
        });
    }
}
// ---------------------------------------------------

// ubah status jadi 2 jika ujian telah selesai
var ujian_run = <?php echo $run ?>;
for (var key in ujian_run) {
    var start       = (key, ujian_run[key][5]);
    var finish      = (key, ujian_run[key][6]);
    var ujian_id    = (ujian_run[key][0]);

    const selesai   = new Date(finish).getTime();
    const sekarang  = new Date().getTime();
    const selisih   = selesai - sekarang;

    if( selisih < 0 ) {
        $.ajax({
            url: "{{ url('stop/exam') }}",
            type: "GET",
            dataType: 'json',
            data: {
                ujian_id: ujian_id
            },
            success: function(data) {
                console.log(data);
            }
        });
    }
}
// ---------------------------------------------------

</script>
@endsection
