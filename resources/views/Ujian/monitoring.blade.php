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
@if(session('sukses'))
  <div class="alert alert-success" role="alert">
    {{session('sukses')}}
  </div>
@endif

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
                    <button type="submit" onclick="openFullscreen(this.id);" id="{{$item->id}}" class="btn btn-info btn-sm monitoring" data-ujian_id="{{$item->id}}">
                        <i class="fa fa-laptop fa-sm"></i> Monitoring Ujian
                    </button>

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

<!-- fullscreen monitoring ujian   -->
<div id="fullscreenExam">

      <div class="row">
            <div class="card pl-7 pt-7 pt-3 text-center" style="border-radius:0px; height:120px; width:100%; background: linear-gradient(180deg, rgba(247, 253, 251, 0.85) 0%, rgba(39, 182, 130, 0.85) 100%);" >
                <div class="row">
                    <div class="col-md-9 offset-sm-1">
                        <h3><strong><span id="nama_ujian"></span></strong></h3>
                        <h5><strong><span id="teks_durasi"></span></strong></h5>
                    </div>
                    <div class="col-md-2">
                        <div class="mr-5" style="text-align:right; vertical-align:top;" id="buttonclose"><button class="btn btn-danger" style="font-size:15px;" onclick="closeFullscreen();"> <span class="fa fa-window-close"></span> <strong>Keluar</strong>  </button> </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="row justify-content-center">
                    <div class="card mt-4 ml-10 mr-10" style="border-radius:0px; background:black; box-shadow:0px 0px 0px black;">
                        <video autoplay="true" id="video-webcam" width="600px" height="440px"> </video>
                    </div>
                </div>
                <div class="row">


                </div>
            </div>
            <div class="col-md-3">
                <div class="card pt-20" style="border-radius:0px; height:650px; background: linear-gradient(180deg, rgba(17, 0, 23, 0.96) -83.9%, rgba(44, 5, 60, 0.96) -2.49%, #5E2575 54.53%, #BEA2CF 111.53%);">
                    <div class="container">

                        <div class="row text-center ml-4 mr-4"  style="font-size:18px; font-weight:bold; color:white;"> <strong>Peserta Ujian</strong> </div> <hr>
                        <div id="teks_peserta" class="ml-4 mr-4 " style="font-size:16px; font-weight:bold; color:white;"></div>
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- penutup fullscreen  -->

<script>

$("#fullscreenExam").hide();

// Menampilkan fullscreen pengawasan ujian
var elem = document.querySelector("#fullscreenExam");
function openFullscreen(ujian_id) {

    // mengirim data id ujian yang dipilih untuk monitoring
    // var ujian_id    = $(this).data('ujian_id');  // data id ujian belum tertangkap
    // var ujian_id    = $(".ujian_id").val();
    console.log(ujian_id);
    $.ajax({
        url: "{{ url('fullscreen/room/exam') }}",
        type: "GET",
        dataType: 'json',
        data: {
            ujian_id: ujian_id
        },
        success: function(data) {
            // console.log(data);
            array_data = Object.values(data);

            var nama_ujian = array_data[0];
            var waktu_mulai = array_data[1];
            var durasi = array_data[2];
            var waktu_selesai = array_data[3];
            var array_peserta = array_data[4];
            // console.log(array_peserta);
            // mengambil setiap value peserta dari array peserta
            for (var key in array_peserta) {
                var peserta = (array_peserta[key]);
                // menampilkan peserta pada html
                const teks_peserta = document.getElementById('teks_peserta');
                teks_peserta.innerHTML = '<li>' + peserta + '</li>';
            }
            $("#nama_ujian").text(nama_ujian);
            $("#waktu_mulai").text(waktu_mulai);
            $("#durasi").text(durasi);
            $("#waktu_selesai").text(waktu_selesai);

            // pengaturan JS untuk membuat hitung durasi sisa waktu ujian
            const selesai       = new Date(waktu_selesai).getTime();
            const hitung_durasi = setInterval(function() {
                const sekarang      = new Date().getTime();
                const sisa_durasi   = selesai - sekarang;

                const jam   = Math.floor(sisa_durasi % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
                const menit = Math.floor(sisa_durasi % (1000 * 60 * 60 ) / (1000 * 60 ));
                const detik = Math.floor(sisa_durasi % (1000 * 60 ) / 1000 );

                const teks_durasi = document.getElementById('teks_durasi');
                teks_durasi.innerHTML = 'Ujian akan di berakhir dalam : ' + jam + ' jam ' + menit + ' menit ' + detik + ' detik lagi ';

                if( durasi < 0 ) {
                    clearInterval(hitung_durasi);
                    closeFullscreen();
                }
            }, 1000);

            // for (var key in array_data) {
            //     var nama_ujian = (key, array_data[key][1]);
            //     console.log(nama_ujian);

            // }
            // var ujian_room_id = data;
            // $("#ujian_room_id").val(ujian_room_id);
        }
    });

    $("#fullscreenExam").show();
    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    }


}

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

//Pengaturan JS untuk akses kamera user
var video = document.querySelector("#video-webcam");
navigator.getUserMedia   =  navigator.getUserMedia ||
                            navigator.webkitGetUserMedia ||
                            navigator.mozGetUserMedia ||
                            navigator.msGetUserMedia ||
                            navigator.oGetUserMedia;
if (navigator.getUserMedia) {
    navigator.getUserMedia({ video: true }, handleVideo, videoError);
}
function handleVideo(stream) {
    video.srcObject = stream;
}
function videoError(e) {
    alert("Izinkan menggunakan webcam untuk demo!")
}

// keluar dari fullscreen
function closeFullscreen() {
    if (document.exitFullscreen) {
        document.exitFullscreen();
        $("#fullscreenExam").hide();
    }
}

// tombol monitoring di klik, fullscreen tampil. bawa data ujian id ke kontroller. balikin detail ujian
// hitung durasi
// kalo duraasi habis, update status ujian jadi finish
    // var options         = {  year: 'numeric', month: 'numeric', day: 'numeric', hour: 'numeric', hour24:true, minute: 'numeric', second: 'numeric' };
    // var d               = new Date().toLocaleString("en-US",options, {timeZone: "Asia/Jakarta"});
    // var jam             = parseInt(d.toISOString().substr(11,2)) + 7 ;
    // var menit_detik     = d.toISOString().substr(13, 6);
</script>
@endsection
