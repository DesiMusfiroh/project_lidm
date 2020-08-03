@extends('layouts.layout_siswa')
@section('title')
<title>Wait Ujian</title>
@stop
@section('content')
<style>
@media screen and (max-width: 1000px) {
   #mulai-ujian {max-width:100%;}
   #fullscreenExam{
     height: 100%;
     overflow-y: scroll;
   }

   video{
       background: #ccc;
       border: 5px solid grey;
       margin: auto;


   }
}
:fullscreen {
  background:linear-gradient(360deg, rgba(247, 253, 251, 0.85) -4.38%, rgba(118, 235, 179, 0.85) 19.69%, rgba(14, 239, 185, 0.85) 98.54%);
}
.head_exam {
  background: linear-gradient(180deg, rgba(17, 0, 23, 0.96) -83.9%, rgba(44, 5, 60, 0.96) -2.49%, #5E2575 54.53%, #BEA2CF 111.53%);
  border-radius: 20px 20px 0px 0px;
  border: none;
}
video{
    background: #ccc;
    border: 5px solid grey;
    margin-right: 10px;

}


</style>
<div class="row">
<div class="col-md-8">
<div class="card"  style="border-radius:20px;  box-shadow: 5px 5px 10px rgba(48, 10, 64, 0.5);" >
    <div class="card-header text-center "  style="border-radius: 20px 20px 0px 0px;  background: #EDE5E5;">
        <strong style="font-size:18px;">{{ $ujian->nama_ujian}}</strong>
    </div>
    <div class="card-body">
        <?php
          use App\Guru;
          $durasi_jam   =  date('H', strtotime($ujian->paket_soal->durasi));
          $durasi_menit =  date('i', strtotime($ujian->paket_soal->durasi));
          $pembuat_ujian = Guru::where('id',$ujian->guru_id)->value('nama_lengkap');
        ?>
        <table>
          <tr><td width="140px">Pembuat Ujian </td> <td  width="10px"> : </td> <td>{{$pembuat_ujian}}</td></tr>
          <tr><td>Waktu Mulai </td> <td> : </td> <td>{{$ujian->waktu_mulai}}</td></tr>
          <tr><td>Durasi Ujian </td> <td> : </td> <td> {{ $durasi_jam }} jam {{ $durasi_menit }} menit</td></tr>
        </table>
        <div class="alert alert-warning text-center mt-2 pt-2 pb-2 mb-1">
          <div id="teks"></div>
        </div>

    </div>
    <div class="card-footer  text-center " id="start">
        <!-- <a href="{{route('runUjian',$ujian->id)}}"><button  class="btn btn-warning">Mulai</button></a> -->
        <button class="btn btn-success" id="mulai-ujian" onclick="openFullscreen();" style="width:400px; box-shadow: 3px 2px 5px grey;">Mulai Ujian</button>
    </div>
</div>
</div>

<div class="col-md-4">
  <div class="alert alert-warning" role="alert">
          <h4 class="alert-heading">Ketentuan</h4>
          <ul class="pl-3">
            <li> Ujian dapat di mulai ketika telah memasuki <b>waktu mulai ujian.</b></li>
            <li> <b>Kamera</b> peserta akan selalu aktif selama pengerjaan ujian.</li>
            <li> Tidak diperkenankan keluar dari <b>mode fullscreen</b> jika ujian belum diselesaikan.</li>
            <li> <b>Jika keluar dari mode Fullscren, Jawaban akan tersimpan, dan ujian tidak bisa diulangi</b> </li>
          </ul>
          <hr>
        </div>
    </div>
  </div>


<div id=fullscreenExam >
  <div class="container">
<br> <br>

    <div class="row">
      <div class="col-md-12">
        <div class="card pt-3 pl-5 pr-5 pb-3 head_exam">
          <div class="text-center"> <h4 style="color:white;"> <strong>{{ $ujian->nama_ujian }}</strong></h4> </div>
          <h6  style="color:#6fedae;"> <strong> Durasi Pengerjaan : {{ $durasi_jam }} jam {{ $durasi_menit }} menit </strong> </h6>
          <div style="color:#6fedae; font-weight:bold;" id="teks_durasi"></div>
        </div>
      </div>
    </div>

    <div id="table_data">
      @include('Ujian-Siswa.pagination_data')

    </div>

    <div class="row">
      <div class="col-md-8"></div>
      <div class="col-md-4">
        <a href="{{route('finishUjian',$peserta->id)}}"> <button class="btn btn-danger" onclick="closeFullscreen();" peserta_id="{{$peserta->id}}"> Akhiri Ujian </button> </a>
      </div>
    </div>


    <div class="container video">
      <div  class="row">
        <video autoplay="true" id="video-webcam" width="160px" height="122px"> </video>
      </div>
    </div>

  </div>
</div>


<script>
$("#fullscreenExam").hide();
$("#text").hide();
$("#start").hide();
var elem = document.querySelector("#fullscreenExam");
function openFullscreen() {
    $("#fullscreenExam").show();
    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    }
    const waktu_selesai = new Date('<?php echo $waktu_selesai ?>').getTime();
    const hitung_durasi = setInterval(function() {
        const sekarang = new Date().getTime();
        const durasi = waktu_selesai - sekarang;
        const jam = Math.floor(durasi % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
        const menit = Math.floor(durasi % (1000 * 60 * 60 ) / (1000 * 60 ));
        const detik = Math.floor(durasi % (1000 * 60 ) / 1000 );
        const teks_durasi = document.getElementById('teks_durasi');
        teks_durasi.innerHTML = 'Ujian akan di berakhir dalam : ' + jam + ' jam ' + menit + ' menit ' + detik + ' detik lagi ';
        if( durasi < 0 ) {
            clearInterval(hitung_durasi);
            teks_durasi.innerHTML = 'Ujian telah berakhir';
            closeFullscreen();
        }
    }, 1000);
    // alert("ini fullscreen");
    // $(elem).mouseleave(function(){
    //   // const keluar = confirm("jika anda keluar dari window, ujian akan berakhir");
    //   //
    //   // if (!keluar) {
    //   //   alert("semangat ngerjainnya. jangan nyontek ya");
    //   //   window.history.openFullscreen();
    //   // }else {
    //   //   closeFullscreen();
    //   // }
    //   alert("Hayoooo jangan nyontek ya. jangan kemana mana");
    //   closeFullscreen();
    // });

    $('#fullscreenExam').mouseleave(function(){
      const peserta_id = $(this).attr('peserta_id');
      closeFullscreen();
      swal({
        title: "Yakin?",
        text: "Ketika meninggalkan ujian, anda tidak bisa mengulangi ujian lagi.Tekan cancel untuk kembali ujian",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location = "/finish/"+peserta_id;
        }
      });

    });
}
function closeFullscreen() {
    if (document.exitFullscreen) {
        document.exitFullscreen();
        $("#fullscreenExam").hide();
    }
}

// --------------------------------------------------------------------------
// pengaturan JS untuk hitung waktu mulai ujian
const waktu_mulai = new Date('<?php echo $waktu_mulai ?>').getTime();
const hitung_mundur = setInterval(function() {
    const waktu_sekarang = new Date().getTime();
    const selisih = waktu_mulai - waktu_sekarang;
    const hari = Math.floor(selisih / (1000 * 60 * 60 *24));
    const jam = Math.floor(selisih % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
    const menit = Math.floor(selisih % (1000 * 60 * 60 ) / (1000 * 60 ));
    const detik = Math.floor(selisih % (1000 * 60 ) / 1000 );
    const teks = document.getElementById('teks');
    teks.innerHTML = '<strong> Ujian akan di mulai dalam : ' + hari + ' hari ' + jam + ' jam ' + menit + ' menit ' + detik + ' detik lagi !</strong> ';
    $("#start").hide();
    if( selisih < 0 ) {
        clearInterval(hitung_mundur);
        teks.innerHTML = 'Ujian Dapat di mulai';
        $("#start").show();
    }
}, 1000);
// --------------------------------------------------------------------------
//Pengaturan JS untuk akses kamera user
    // seleksi elemen video
    var video = document.querySelector("#video-webcam");
    // minta izin user
    navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;
    // jika user memberikan izin
    if (navigator.getUserMedia) {
        // jalankan fungsi handleVideo, dan videoError jika izin ditolak
        navigator.getUserMedia({ video: true }, handleVideo, videoError);
    }
    // fungsi ini akan dieksekusi jika  izin telah diberikan
    function handleVideo(stream) {
        video.srcObject = stream;
    }
    // fungsi ini akan dieksekusi kalau user menolak izin
    function videoError(e) {
        // do something
        alert("Izinkan menggunakan webcam untuk demo!")
    }
// Pengaturan JS untuk Pagination
$(document).ready(function(){
    $(document).on('click', '.pagination a',function(event){
        event.preventDefault(); //stop refresh webpage
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });
    function fetch_data(page)
    {
        const peserta_id = $('#peserta_id').val();
        $.ajax({
            url:"/pagination/fetch_data?page="+page,
            type: "GET",
            data: {
              peserta_id: peserta_id
            },
            success: function(soal_satuan)
            {
                $('#table_data').html(soal_satuan);
            }
        });
    }
});
// ------------------------------------------------------------
</script>
@endsection
