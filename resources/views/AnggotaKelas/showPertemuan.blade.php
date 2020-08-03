@extends('layouts.layout_siswa')

@section('title')
    <title>Unbreakable</title>
@endsection

<style>
    @media screen and (max-width: 1000px) {
    #mulai-pertemuan {max-width:100%;}
    #fullscreenExam{
        height: 100%;
        overflow-y: scroll;
    }
    }
    :fullscreen {
        background: linear-gradient(180deg, #12C3CE 0%, #D7E8E9 100%);
    }
</style>

<?php 
    Use App\Kelas;
?>
@section('content')
<main class="main">
    <div>
      <!-- {{ Breadcrumbs::render('pertemuan.show',$pertemuan->kelas,$pertemuan) }} -->
    </div>
    <div class="container-fluid">

        <!-- judul pertemuan kelas -->
        <div class="row">
            <div class="col-md-8">
                <div class="card" >
                    <div class="card-header"><strong> {{$pertemuan->nama_pertemuan}}</strong></div> 
                    <div class="card-body">
                        {{$pertemuan->deskripsi}}
                        <br>
                        Waktu Mulai Pertemuan: {{$waktu_mulai}}
                        @if ($pertemuan->status == 0) 
                        <div class="text-center"><div class="alert alert-info pt-0 pb-0 mt-2 mb-0" id="teks"></div></div> 
                        @elseif ($pertemuan->status == 1)
                        <div class="text-right mt-2" id="start">
                            <input type="hidden" id="pertemuan_id" value="{{$pertemuan->id}}">
                            <input type="hidden" id="anggota_kelas_id" value="{{$anggota_kelas_id}}">
                            <!-- <button class="btn btn-success" id="masuk_pertemuan" onclick="openFullscreen();" style="width:40%; box-shadow: 3px 2px 5px grey;">Masuk Ruang Pertemuan</button> -->
                            <a href="{{route('pertemuanSiswa.ruang',['kelas_id'=>$pertemuan->kelas->id,'id_pertemuan'=>$pertemuan->id])}} "><button class="btn btn-success" style="width:40%; box-shadow: 3px 2px 5px grey;" onclick="absensi()">Masuk Ruang Pertemuan</button> </a>
                        </div> 
                        @elseif ($pertemuan->status == 2)
                        <div class="text-center"> <div class="alert alert-warning pb-0 pt-0  mb-0 mt-2" id="end">Pertemuan Telah berakhir</div></div>
                        @endif
                    </div>                      
                </div>
            </div>
            <div class="col-md-4">
                <div class="alert alert-info" role="alert">
                    <h6 class="alert-heading"><strong>{{$pertemuan->kelas->nama_kelas}}</strong></h6>
                    <p>{{$pertemuan->kelas->deskripsi}}<br/>
                    </p>
                    <hr>
                </div>
            </div>
        </div>

        <!-- navbar absensi, kelompok, tugas -->
        <div class="row">
            <div class="col-md-12">
                <div class="card pt-3 pr-3 pl-3 pb-3">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="absensi-tab" data-toggle="tab" href="#absensi" role="tab" aria-controls="absensi" aria-selected="false">Absensi Siswa</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link " id="kelompok-tab" data-toggle="tab" href="#kelompok" role="tab" aria-controls="kelompok" aria-selected="false">Kelompok</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link " id="messages-tab" data-toggle="tab" href="#tugas" role="tab" aria-controls="tugas" aria-selected="false">Tugas</a>
                        </li>
                    </ul>

                    <div class="tab-content mr-3 ml-3">
                        <div class="tab-pane active" id="absensi" role="tabpanel" aria-labelledby="absensi-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-warning" role="alert">
                                            Absesnsi belum ada
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="kelompok" role="tabpanel" aria-labelledby="kelompok-tab">
                            <div class="mb-3 text-right">
                                <a href="#"> <button class="btn btn-success">Buat Kelompok</button> </a>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-warning" role="alert">
                                            Belum ada kelompok yang dibuat
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tugas" role="tabpanel" aria-labelledby="tugas-tab">
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="alert alert-warning" role="alert">
                                            Belum ada tugas yang dibuat
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- fullscreen ruang pertemuan -->
        <!-- <div id="fullscreenPertemuan">
            <div class="row">
                <div class="col-md-12">
                    <div class="card bg-heavy-rain mt-3 mr-3 ml-3 pt-3 pb-2 pr-3 pl-3">
                        <div class="row">
                            <div class="col text-center"><h4><strong>{{$pertemuan->kelas->nama_kelas}}</strong></h4></div>
                            <div class="col col-md-3 text-right"><h5><strong> {{$pertemuan->nama_pertemuan}}</strong></h5></div>
                        </div>                   
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-9 pl-3">
                
                    <div id="carouselExampleIndicators" class="carousel slide ml-5" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="container video">
                                    <div class="row">
                                        <video autoplay="true" id="video-webcam"> </video>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                            <img src="..." class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                            <img src="..." class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div> 
               
                <div class="col-md-3">
                    <div class="card bg-heavy-rain mr-3 ml-3 pt-3 pb-2 pr-3 pl-3">
                        <div class="accordion" id="accordionExample">
                            <div class="card mb-1">
                                <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <strong>Daftar Siswa</strong> 
                                    </button>
                                </h2>
                                </div>

                                <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                                </div>
                            </div>
                            <div class="card mb-1">
                                <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <strong>Daftar Kelompok</strong> 
                                    </button>
                                </h2>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <strong>Live Chat</strong> 
                                    </button>
                                </h2>
                                </div>
                                <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                @if($chat_pertemuan->count() != 0)
                                        @foreach ($chat_pertemuan as $item)
                                            @if ($item->user_id == Auth::user()->id)
                                            <div class="alert alert-sm alert-warning pb-0 pt-0 mb-1">{{$item->user->name}} - {{$item->pesan}}</div> 
                                            @else
                                            <div class="alert alert-sm alert-success pb-0 pt-0 mb-1">{{$item->user->name}} - {{$item->pesan}}</div> 
                                            @endif
                                        @endforeach
                                    @endif
                                    <div class="input-group mb-3">
                                    <input type="text" id="isipesan" class="form-control" placeholder="..." aria-label="" aria-describedby="button-addon2">
                                    <input type="hidden" id="user_id" value="{{Auth::user()->id}}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="sendMessage();">Button</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-2">
                    <div class="card bg-heavy-rain mt-3 mr-3 ml-3 pt-3 pb-2 pr-3 pl-3">
                        <button class="btn btn-warning" onclick="closeFullscreen();" >Leave</button>
                    </div>
                   
                </div>
                <div class="col-md-10">
                
                </div>
            </div>
        </div> -->

    </div>
</main>

<script>
// menampilkan isi navbar
    $(function () {
        $('#myTab li:last-child a').tab('show')
    });

// pengaturan JS untuk hitung waktu mulai pertemuan
const waktu_mulai = new Date('<?php echo $waktu_mulai ?>').getTime();
    const hitung_mundur = setInterval(function() {
        const waktu_sekarang = new Date().getTime();
        const selisih = waktu_mulai - waktu_sekarang;

        const hari  = Math.floor(selisih / (1000 * 60 * 60 *24));
        const jam   = Math.floor(selisih % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
        const menit = Math.floor(selisih % (1000 * 60 * 60 ) / (1000 * 60 ));
        const detik = Math.floor(selisih % (1000 * 60 ) / 1000 );

        const teks  = document.getElementById('teks');
        teks.innerHTML = '<strong> Ruang pertemuan dapat digunakan dalam : ' + hari + ' hari ' + jam + ' jam ' + menit + ' menit ' + detik + ' detik lagi !</strong> ';
        $("#start").hide();
        if( selisih < 0 ) {
            clearInterval(hitung_mundur);
            teks.innerHTML = '';
            $("#start").show();
            $("#teks").hide();
            // jika telah masuk waktu mulai, status pertemuan berubah jadi 1
            var pertemuan_id = $("#pertemuan_id").val();
            $.ajax({
                url: "{{ url('pertemuan/start') }}",
                type: "GET",
                dataType: 'json',
                data: {
                    pertemuan_id: pertemuan_id,
                },
                success: function(data) {
                    console.log(data);
                    location.reload(true); // refresh page otomatis         
                }
            });  
        }
    }, 1000);

// absensi terisi juka masuk pertemuan di klik
    function absensi() {
        var pertemuan_id = $("#pertemuan_id").val();
        var anggota_kelas_id = $("#anggota_kelas_id").val();
        $.ajax({
            url: "{{ url('absensi/create') }}",
            type: "GET",
            dataType: 'json',
            data: {
                pertemuan_id: pertemuan_id,
                anggota_kelas_id: anggota_kelas_id
            },
            success: function(data) {
                console.log(data);
            }
        });
    }
// pengaturan JS untuk fullscreen pertemuan
    // $("#fullscreenPertemuan").hide(); 
    // var elem = document.querySelector("#fullscreenPertemuan");
    // function openFullscreen() {
    //     $("#fullscreenPertemuan").show();

    //     if (elem.requestFullscreen) {
    //         elem.requestFullscreen();   
    //         // akses kamera user           
    //         var video = document.querySelector("#video-webcam");
    //         navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;
    //         if (navigator.getUserMedia) {
    //             navigator.getUserMedia({ video: true }, handleVideo, videoError);
    //         }
    //         function handleVideo(stream) { video.srcObject = stream; }
    //         function videoError(e) { alert("Izinkan menggunakan webcam untuk demo!") }
    //     }
    //     // create / update data absensi
    //     var pertemuan_id = $("#pertemuan_id").val();
    //     var anggota_kelas_id = $("#anggota_kelas_id").val();
    //     $.ajax({
    //         url: "{{ url('absensi/create') }}",
    //         type: "GET",
    //         dataType: 'json',
    //         data: {
    //             pertemuan_id: pertemuan_id,
    //             anggota_kelas_id: anggota_kelas_id
    //         },
    //         success: function(data) {
    //             console.log(data);
    //         }
    //     });
    // }

// kirim pesan live chat
    // function sendMessage() {
    //     var pesan = $("#isipesan").val();
    //     var pertemuan_id = $("#pertemuan_id").val();
    //     var user_id = $("#user_id").val();
    //     $.ajax({
    //         url: "{{ url('chat_pertemuan/send') }}",
    //         type: "GET",
    //         dataType: 'json',
    //         data: {
    //             pertemuan_id: pertemuan_id,
    //             user_id: user_id,
    //             pesan: pesan
    //         },
    //         success: function(data) {
    //             console.log(data);
    //             $("#isipesan").val('');
    //         }
    //     });
    // }

// fungsi keluar dari fullscreen pertemuan
    // function closeFullscreen() {
    //     if (document.exitFullscreen) {
    //         document.exitFullscreen();
    //         $("#fullscreenPertemuan").hide();
    //     }
    // }

// keluar otomatis dari fullscreen saat klik esc atau x
    // $('#fullscreenPertemuan').mouseleave(function(){
    //     closeFullscreen();
    // });

</script>

@endsection