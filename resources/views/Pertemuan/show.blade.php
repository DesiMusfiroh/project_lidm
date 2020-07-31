@extends('layouts.layout_guru')

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
      {{ Breadcrumbs::render('pertemuan.show',$pertemuan->kelas,$pertemuan) }}
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
                        <div class="text-center" id="teks"></div>  
                        <div class="text-right mt-2" id="start">
                            <button class="btn btn-success" id="masuk_pertemuan" onclick="openFullscreen();" style="width:40%; box-shadow: 3px 2px 5px grey;">Masuk Ruang Pertemuan</button>
                        </div>  
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
        <div id="fullscreenPertemuan">
        
        </div>

    </div>
</main>

<script>
// menampilkan isi navbar
    $(function () {
        $('#myTab li:last-child a').tab('show')
    });

// pengaturan JS untuk fullscreen pertemuan
    $("#fullscreenPertemuan").hide(); 
    var elem = document.querySelector("#fullscreenPertemuan");
    function openFullscreen() {
    $("#fullscreenPertemuan").show();
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        }
    }

// fungsi keluar dari fullscreen pertemuan
    function closeFullscreen() {
        if (document.exitFullscreen) {
            document.exitFullscreen();
            $("#fullscreenExam").hide();
        }
    }

// keluar otomatis dari fullscreen saat klik esc atau x
    $('#fullscreenExam').mouseleave(function(){
        closeFullscreen();
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
        }
    }, 1000);
    
</script>

@endsection