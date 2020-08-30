@extends('layouts.layout_ruang')

@section('content')
    <div id="fullscreenExam">
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-heavy-rain mt-3 mr-3 ml-3 pt-3 pb-2 pr-3 pl-3" style="min-height:80px;">
                    <div class="row">
                        <div class="col md-12 text-center">
                            <h4><strong>{{$ujian->nama_ujian}}</strong></h4>
                            <strong><div id="teks_durasi"></div></strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                    <div id="local-videos-container"></div>
                    </div>
                    <div class="col-md-4">
                    <div id="remote-videos-container"></div>
                    </div>
                </div>
                <div class="row">

                </div>
            </div>
            <div class="col-md-3">
                <div class="card mr-3" >
                    <div class="card-header">
                        <div class="row text-center ml-4 mr-4"  style="font-size:18px; font-weight:bold; "> <strong>Peserta Ujian</strong> </div> 
                    </div>
                    <div class="card-body">
                        <ul>
                        @foreach ($peserta_ujian as $item)
                            <li>{{$item->anggota_kelas->siswa->nama_lengkap}}</li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-md-12">
                        <a href="{{route('guru.ujian.monitoring')}}"><button class="btn btn-danger">Keluar</button></a>
                    </div>    
                </div>
            </div>
        </div>
</div>
@endsection

@section('js')

<script src="https://unpkg.com/rtcmulticonnection@latest/dist/RTCMultiConnection.min.js"></script>
<script src="https://rtcmulticonnection.herokuapp.com/socket.io/socket.io.js"></script>
<script type= 'text/javascript'>

var connection = new RTCMultiConnection();

// v3.4.7 or newer

connection.socketURL = 'https://rtcmulticonnection.herokuapp.com:443/';
connection.session = {
    audio: true,
    video: true
};

connection.sdpConstraints.mandatory = {
OfferToReceiveAudio: true,
OfferToReceiveVideo: true
};

var localVideosContainer = document.getElementById('local-videos-container');
var remoteVideosContainer = document.getElementById('remote-videos-container');

connection.onstream = function(event) {
    var video = event.mediaElement;
    if(event.type === 'local') {
        localVideosContainer.appendChild( video ).style.width = "300px";
    }
    if(event.type === 'remote') {
        remoteVideosContainer.appendChild( video ).style.width = "300px";
    }
}

$( document ).ready(function() {
    this.disable = true;
    connection.openOrJoin('predefiend-roomid');
});

// hitung sisa durasi ujian
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
        }
    }, 1000);
</script>
@endsection