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
    {{ Breadcrumbs::render('pertemuanSiswa.show',$pertemuan->kelas,$pertemuan) }}
  </div>
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
                        @if ($pertemuan->status == 0 || $pertemuan->status == 1  )
                        <div class="text-center"><div class="alert alert-info pt-0 pb-0 mt-2 mb-0" id="teks"></div></div>
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
                            <a class="nav-link " id="tugas-tab" data-toggle="tab" href="#tugas" role="tab" aria-controls="tugas" aria-selected="false">Tugas</a>
                        </li>
                    </ul>

                    <div class="tab-content mr-3 ml-3">
                        <div class="tab-pane active" id="absensi" role="tabpanel" aria-labelledby="absensi-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-warning" role="alert">
                                            Absensi belum ada
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="kelompok" role="tabpanel" aria-labelledby="kelompok-tab">
                            <div class="row">
                               <div class="col-md-12">
                                        <div class="alert alert-warning" role="alert">
                                            Anda tidak memiliki kelompok
                                        </div>
                                </div>
                               
                            </div>
                        </div>

                        <div class="tab-pane" id="tugas" role="tabpanel" aria-labelledby="tugas-tab">
                            <div class="row">
                                <div class="col-md-12">
                                 @if($tugas_individu_master->count() != 0)
                                    <table class="table table-striped table-sm text-center">
                                        <thead class=" thead text-center">
                                            <tr>
                                                <td width="30px">No</td>
                                                <td>Nama Tugas</td>
                                                <td>Tipe Tugas</td>
                                                <td>Deadline</td>
                                                <td align="center">Opsi</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i=1; ?>
                                        @foreach ($tugas_individu_master as $item)
                                            <tr>
                                                <td><?php echo $i; $i++?></td>
                                                <td>{{$item->nama_tugas}}</td>
                                                <td>{{$item->jenis}}</td>
                                                <td>{{$item->deadline}}</td>

                                                <td>
                                                <button class="btn btn-info btn-sm"  data-toggle="modal" data-target=".create_modal_serahkantugas"
                                                id="create"
                                                data-tugas_individu_master_id = "{{ $item->id }}"
                                                data-anggota_kelas_id = "{{ $item->kelas->anggota_kelas_id }}">Serahkan Tugas</button> 
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                 @else
                                    <div class="col-md-12">
                                        <div class="alert alert-warning" role="alert">
                                            Belum ada tugas yang dibuat
                                        </div>
                                    </div>
                                 @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
</main>

<script>
// menampilkan isi navbar
    $(function () {
        $('#myTab li:first-child a').tab('show')
    });
    $("#start").hide();

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
                    // location.reload(true); // refresh page otomatis
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



  $(document).ready(function(){
        $(document).on('click','#create', function(){
            var tugas_individu_master_id                = $(this).data('tugas_individu_master_id');
            var anggota_kelas_id                        = $(this).data('anggota_kelas_id');
          
            $('#tugas_individu_master_id').val(tugas_individu_master_id);
            $('#anggota_kelas_id').val(anggota_kelas_id);
        });
    });
    
</script>
@endsection

<!-- Create Modal (Serahkan Tugas Individu)-->
<div class="modal fade create_modal_serahkantugas"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title " id="exampleModalLabel">Serahkan Tugas Individu </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{route('serahkanTugasIndividu')}}" enctype="multipart/form-data" method="post">
                {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="container">

                            <input type="hidden" name="tugas_individu_master_id" class="tugas_individu_master_id" value="">
                            <input type="hidden" name="anggota_kelas_id" class="anggota_kelas_id" value="">
                            <div class="form-group">
                                <label for="alamat"> Upload Tugas </label>
                                <input type="file" class="form-control"  id="tugas" name="tugas" >
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Penutup Create Modal -->