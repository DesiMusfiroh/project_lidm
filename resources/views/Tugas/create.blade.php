@extends('layouts.layout_guru')

@section('title')
    <title>Unbreakable</title>
@endsection
<?php
use App\TugasIndividuMaster;
use App\TugasIndividu;
use App\Kelas;
?>
@section('content')
<main class="main">
    <div>
        {{ Breadcrumbs::render('tugas.create',$kelas) }}
    </div>
    <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
            <div class="card-header">
                <div class="card-title">Buat Tugas </div>
            </div>
                <div class="card-body">  
                    <div class="mr-3 ml-3 row alert alert-success">
                        <div class="col-md-5">
                            <input type="text" value="Pilih Tipe Tugas :" class=" btn btn-secondary mb-3" readonly>
                        </div>
                        <div class="col-md-7">
                        <button type="submit" class="btn btn-success" data-toggle="modal" data-target=".create_modal_individu"
                                id="create"
                                data-kelas_id = "{{ $kelas_id }}"
                                style="box-shadow: 3px 2px 5px grey; margin:5px;">Tugas Individu</button>
                        <button type="submit" class="btn btn-info" data-toggle="modal" data-target=".create_modal_kelompok"
                                id="create"
                                data-kelas_id = "{{ $kelas_id }}"
                                style="box-shadow: 3px 2px 5px grey; margin:5px;">Tugas Kelompok</button>
                        </div>  
                    </div>               
                </div>
            </div>
        </div>
    </div>
    </div>
</main>

<script>
    $(document).ready(function(){
        $(document).on('click','#create', function(){
           
            var kelas_id   = $(this).data('kelas_id');

            $('.kelas_id').val(kelas_id);

        });
    });
    
</script>
@endsection

<!-- Create Modal (Tugas Individu)-->
<div class="modal fade create_modal_individu"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title " id="exampleModalLabel">Buat Tugas Individu </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{route('storeTugasIndividu')}}" enctype="multipart/form-data" method="post">
                   @csrf
                    <div class="modal-body">
                        <div class="container">

                            <input type="hidden" name="kelas_id" class="kelas_id" value="">

                            <div class="form-group">
                                <label for="alamat"> Nama Tugas </label>
                                <input type="text" class="form-control"  name="nama_tugas" >
                            </div>
                            <div class="form-group">
                            <label for="pertemuan"> Pertemuan</label>
                            <select class="form-control" name="pertemuan">
                                <option disabled selected>Pilih ...</option>
                                @foreach($pertemuan as $item)
                                <option value="{{$item->id}}">{{$item->nama_pertemuan}}</option>
                                @endforeach
                            </select>
                            </div>

                            <div class="form-group">
                            <label for="deadline"> Deadline </label>
                                <input type="datetime-local"  class="form-control" name="deadline" >
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info"  onclick=alertIndividu()>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Penutup Create Modal -->

<!-- Create Modal (Tugas Kelompok)-->
<div class="modal fade create_modal_kelompok"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title " id="exampleModalLabel">Buat Tugas Kelompok </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{route('storeTugasKelompok')}}" enctype="multipart/form-data" method="post">
                   @csrf
                    <div class="modal-body">
                        <div class="container">

                            <input type="hidden" name="kelas_id" class="kelas_id" value="">

                            <div class="form-group">
                                <label for="nama_tugas"> Nama Tugas </label>
                                <input type="text" class="form-control"  name="nama_tugas" >
                            </div>
                            <div class="form-group">
                            <label for="kelompok_master_id"> Pilih Kelompok Master</label>
                            <select class="form-control" name="kelompok_master_id">
                                <option disabled selected>Pilih ...</option>
                                @foreach($kelompok_master as $item)
                                <option value="{{$item->id}}">{{$item->deskripsi}}</option>
                                @endforeach
                            </select>
                            </div>

                            <div class="form-group">
                            <label for="deadline"> Deadline </label>
                                <input type="datetime-local"  class="form-control" name="deadline" >
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info" onclick=alertKelompok()>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Penutup Create Modal -->


@section('js')
<script>
function alertIndividu() {
    swal({
        title: "Tugas Individu berhasil dibuat !",
        icon: "success",
    });
}
function alertKelompok() {
    swal({
        title: "Tugas Kelompok berhasil dibuat !",
        icon: "success",
    });
}
</script>
@endsection