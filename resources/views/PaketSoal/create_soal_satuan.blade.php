@extends('layouts.layout_guru')

@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')
<?php
    use App\Essay;
    use App\Pilgan;
    use App\PaketSoal;
?>
<style>
    .subjudul {
        text-align:left;
        font-weight:bold;
    }
    .isi {
        margin-left:30px;
    }
</style>
<!-- <main class="main">
      <div>
        {{ Breadcrumbs::render('buat-paketsoal') }}
      </div> -->
      <div class="container">
    <div class="card">
        <div class="card-header  pt-3 pb-2 text-center" >
            <strong style="font-size:18px;"> Paket Soal : {{$paket_soal->judul}}  </strong>
        </div>
        <div class="card-body">
            <div class="container">
                    <input type="hidden" name="paket_soal_id" value="{{ $paket_soal_id }}">
                    <div class="alert alert-warning">
                        <div class="col-md-12"><strong>Tambah Soal Baru </strong></div>
                        <div class="col-md-12 text-center">
                            Pilih Jenis Soal :
                            <button type="submit" class="btn btn-secondary" data-toggle="modal" data-target=".create_modal_essay"
                                    id="create"
                                    data-paket_soal_id = "{{ $paket_soal_id }}"
                                    style="box-shadow: 3px 2px 5px grey; margin:5px;"> Essay</button>
                            <button type="submit" class="btn btn-info" data-toggle="modal" data-target=".create_modal_pilgan"
                                    id="create"
                                    data-paket_soal_id = "{{ $paket_soal_id }}"
                                    style="box-shadow: 3px 2px 5px grey;"> Pilihan Ganda</button>
                                   </div>
                    </div>
                    <hr>

@if(session('sukses'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{session('sukses')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if($errors->has('poin'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{$errors->first('poin')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if($soal_satuan->count() != 0)

        <div class="container">
            <?php $i=0; ?>
            @foreach($soal_satuan as $item)
                <div class="row">
                    <div class="col-md-10">
                        <h6>Soal No.  <?php  $i++;  echo $i; ?> </h6>

                        @if($item->jenis == "Essay")
                            <div class="subjudul"> Pertanyaan : </div>
                            <div class="isi"> {!!$item->essay->pertanyaan!!} </div>
                            <div class="subjudul"> Kunci Jawaban : </div>
                            <div class="isi"> {!!$item->essay->jawaban!!} </div>

                        @elseif($item->jenis == "Pilihan Ganda")
                            <div class="subjudul"> Pertanyaan : </div>
                            <div class="isi"> {!!$item->pilgan->pertanyaan!!} </div>
                            <div class="subjudul"> Pilihan : </div>
                            <div class="isi">    A . {{$item->pilgan->pil_a}}  <br>
                                B . {{$item->pilgan->pil_b}}  <br>
                                C . {{$item->pilgan->pil_c}}  <br>
                                D . {{$item->pilgan->pil_d}}  <br>
                                E . {{$item->pilgan->pil_e}} </div>
                            <div class="subjudul"> Kunci Jawaban : {{$item->pilgan->kunci}}</div>


                        @endif

                    </div>

                    <div class="col-md-2 text-right">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="background-color:#EDE5E5;">Poin</span>
                            </div>
                            <input type="text" class="form-control" placeholder="{{$item->poin}}" aria-label="Poin" aria-describedby="basic-addon1" disabled>
                        </div>

                        @if ($item->jenis == 'Essay')
                        <!--Button Edit-->
                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target=".update_modal_essay"  style="box-shadow: 3px 2px 5px grey; margin:5px;"
                                    id="update"
                                    data-id_essay_update="{{ $item->essay->id }}"
                                    data-soal_satuan_id_essay_update="{{ $item->essay->soal_satuan_id }}"
                                    data-pertanyaan_essay_update="{!! $item->essay->pertanyaan !!}"
                                    data-jawaban_essay_update="{!! $item->essay->jawaban !!}"
                                    data-poin_essay_update="{{ $item->poin }}"
                                    >
                                    Edit <i class="fa fa-edit"></i>
                        </button>
                        @elseif($item->jenis == "Pilihan Ganda")
                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target=".update_modal_pilgan"  style="box-shadow: 3px 2px 5px grey; margin:5px;"
                                    id="update_pilgan"
                                    data-id_pilgan_update="{{ $item->pilgan->id }}"
                                    data-soal_satuan_id_pilgan_update="{{ $item->pilgan->soal_satuan_id }}"
                                    data-pertanyaan_pilgan_update="{!! $item->pilgan->pertanyaan !!}"
                                    data-pil_a_pilgan_update="{!! $item->pilgan->pil_a !!}"
                                    data-pil_b_pilgan_update="{!! $item->pilgan->pil_b !!}"
                                    data-pil_c_pilgan_update="{!! $item->pilgan->pil_c !!}"
                                    data-pil_d_pilgan_update="{!! $item->pilgan->pil_d !!}"
                                    data-pil_e_pilgan_update="{!! $item->pilgan->pil_e !!}"
                                    data-kunci_pilgan_update="{!! $item->pilgan->kunci !!}"
                                    data-poin_pilgan_update="{!! $item->poin !!}"
                                    >
                                    Edit <i class="fa fa-edit"></i>
                        </button>
                        @endif
                        <a href="#" class="btn btn-sm btn-danger hapus"  style="box-shadow: 3px 2px 5px grey; margin:5px;" paket_soal_id="{{$paket_soal_id}}" soal_satuan_id="{{$item->id}}"> Hapus <i class="fa fa-trash"></i> </a>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
</div>
@endif


</div>

<script>
$(document).ready(function(){
    $(document).on('click','#create', function(){
        var id              = $(this).data('id');
        var paket_soal_id   = $(this).data('paket_soal_id');

        $('#id').val(id);
        $('.paket_soal_id').val(paket_soal_id);

    });
});



</script>

@endsection

<!-- Create Modal (essay)-->
<div class="modal fade create_modal_essay"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title " id="exampleModalLabel"> Soal No. </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{route('storeSingleQuestionEssay')}}" enctype="multipart/form-data" method="post">
                   @csrf
                    <div class="modal-body">
                        <div class="container">

                            <input type="hidden" name="paket_soal_id" class="paket_soal_id" value="">
                            <input type="hidden" name="soal_satuan_id" id="soal_satuan_id" value="">

                            <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">No. 1</label>
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="jenis" name="jenis" value="Essay" readonly >
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend" >
                                            <div class="input-group-text">Poin</div>
                                        </div>
                                        <input type="text" name="poin" id="poin" value=""  class="form-control text-right">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat"> Pertanyaan </label>
                                <textarea class="form-control" id="pertanyaanessay" rows="2" name="pertanyaan" placeholder=""> </textarea>
                            </div>
                            <div class="form-group">
                                <label for="alamat"> Jawaban Benar</label>
                                <textarea class="form-control" id="jawaban" rows="2" name="jawaban" placeholder="opsional"> </textarea>
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
<!-- Create Modal (Pilgan)-->
<div class="modal fade create_modal_pilgan"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title " id="exampleModalLabel"> Soal No. </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{route('storeSingleQuestionPilgan')}}" enctype="multipart/form-data" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="modal-body">
                        <div class="container">

                            <input type="hidden" name="paket_soal_id" class="paket_soal_id" value="">
                            <input type="hidden" name="soal_satuan_id" id="soal_satuan_id" value="">

                            <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">No. 1</label>
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="jenis" name="jenis" value="Pilihan Ganda" readonly>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend" >
                                            <div class="input-group-text">Poin</div>
                                        </div>
                                        <input type="text" name="poin" id="poin" value=""  class="form-control text-right">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat"> Pertanyaan </label>
                                <textarea class="form-control" id="pertanyaanpilgan" rows="2" name="pertanyaan" placeholder=""> </textarea>
                            </div>
                            <div class="form-group" >
                                <!-- Pilihan A-->
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend" style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;">
                                        <span class="input-group-text" > A </span>
                                    </div>
                                    <input type="text" name="pil_a" id="pil_a" class="form-control" >
                                </div>
                                <!-- Pilihan B-->
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend" style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;">
                                        <span class="input-group-text"> B </span>
                                    </div>
                                    <input type="text" name="pil_b" id="pil_b"  class="form-control" >
                                </div>
                                 <!-- Pilihan C-->
                                 <div class="input-group mb-2">
                                    <div class="input-group-prepend" style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;">
                                        <span class="input-group-text" > C </span>
                                    </div>
                                    <input type="text" name="pil_c" id="pil_c"  class="form-control" >
                                </div>
                                 <!-- Pilihan D-->
                                 <div class="input-group mb-2">
                                    <div class="input-group-prepend" style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;">
                                        <span class="input-group-text"> D </span>
                                    </div>
                                    <input type="text" name="pil_d" id="pil_d"  class="form-control" >
                                </div>
                                 <!-- Pilihan E-->
                                 <div class="input-group mb-2">
                                    <div class="input-group-prepend" style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;">
                                        <span class="input-group-text"> E </span>
                                    </div>
                                    <input type="text" name="pil_e" id="pil_e" class="form-control" >
                                </div>
                                <div class="input-group-inline">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Jawaban Benar</label>
                                        <select class="custom-select my-1 mr-sm-2" name="kunci" >
                                            <option selected>Choose...</option>
                                            <option value="A" >A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="E">E</option>
                                        </select>
                                </div>
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
