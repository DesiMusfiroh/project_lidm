@extends('layouts.layout_guru')

@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')
<main class="main">
  <div>
    {{ Breadcrumbs::render('paketsoal.index') }}
  </div>
@if(session('pesan'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{session('pesan')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" >
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <strong style="font-size:18px"> Daftar Paket Soal </strong>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                @endif
                @if($paketsoal->count() != 0)
                <div class="table-inside">
                    <table class="table table-striped table-bordered table-sm">
                        <thead class="text-center bg-dark" style="color:white;">
                            <tr>
                                <th scope="col" style="width:50px">No</th>
                                <th scope="col" >Judul Paket Soal </th>
                                <th scope="col" style="width:150px">Durasi </th>
                                <th scope="col" style="width:130px">Jumlah Soal </th>
                                <th scope="col" style="width:150px">Download </th>
                                <th scope="col" style="width:150px">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; ?>
                            @foreach ($paketsoal as $item)
                            <tr>
                                <td scope="row" class="text-center"><?php   $i++;  echo $i; ?></td>
                                <?php $i++; ?>
                                <td >{{ $item->judul }}</td>
                                <td class="text-center">
                                    <?php
                                    $durasi_jam   =  date('H', strtotime($item->durasi));
                                    $durasi_menit =  date('i', strtotime($item->durasi));
                                    ?>
                                    {{ $durasi_jam }} jam {{ $durasi_menit }} menit
                                 </td>

                                <td class="text-center">{{$item->jumlah_soal()}}</td>
                                <td class="text-center">
                                <a  href="{{route('exportSoal',$item->id)}}"  target="_blank">
                                    <button type="button" class="btn btn-sm btn-info">
                                        <i class="fa fa-download" aria-hidden="true"></i> Soal
                                    </button>
                                </a>
                                <a  href="{{route('exportSoal',$item->id)}}"  target="_blank">
                                    <button type="button" class="btn btn-sm btn-secondary">
                                        <i class="fa fa-download" aria-hidden="true"></i> Kunci
                                    </button>
                                </a>
                               
                                </td>
                                <td class="text-center">
                                <button type="button" class="btn  btn-warning" data-toggle="modal" data-target=".update_modal_paket"
                                    id="update"
                                    data-id_paket_update="{{ $item->id }}"
                                    data-guru_id_paket_update="{{ $item->guru->id }}"
                                    data-judul_paket_update="{!! $item->judul!!}"
                                    data-durasi_paket_update="{!! $item->durasi !!}"
                                     title="Ubah paket soal">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                                </button>
                                <a href="{{route('create_soal_satuan',$item->id)}}" title="Tambah soal">
                                        <button type="button" class="btn btn-success">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                    <a href="#" title="Hapus paket soal" class="hapus" paket_soal_id="{{$item->id}}" paket_soal_judul="{{$item->judul}}">
                                        <button type="button" class="btn btn-danger ">
                                            <i class="fa fa-trash fa-sm"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$paketsoal->links()}}
                </div>
                @else
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong> Belum ada paket soal yang di buat. Silahkan buat paket soal baru!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!--edit essay-->
<script type="text/javascript">
$(document).ready(function(){
    $(document).on('click','#update', function(){
        var id_paket_update        = $(this).data('id_paket_update');
        var guru_id_paket_update   = $(this).data('guru_id_paket_update');
        var judul_paket_update     = $(this).data('judul_paket_update');
        var durasi_paket_update    = $(this).data('durasi_paket_update');
        $('#id_paket_update ').val(id_paket_update );
        $('#guru_id_paket_update').val(guru_id_paket_update);
        $('#judul_paket').val(judul_paket_update );
        $('#durasi_paket_update').val(durasi_paket_update );

        var durasi_awal = document.getElementById("durasi_paket_update").value;

        // var timeControl = document.querySelector('input[type="time"]');
        // timeControl.value = durasi_awal.toISOString().substring(7, 16);
        console.log(durasi_awal);
    });
    $('.hapus').click(function(){

      var paket_soal_id = $(this).attr('paket_soal_id');
      var paket_soal_judul = $(this).attr('paket_soal_judul');
      swal({
        title: "Yakin?",
        text: "Menghapus ujian "+paket_soal_judul+ " ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location = 'paketsoal/delete/'+paket_soal_id;
        }
      });
    });
});

</script>
<!--edit-->
@endsection


<!-- update Modal (paket)-->
<div class="modal fade update_modal_paket"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title " id="exampleModalLabel"> <strong>Edit Paket Soal</strong> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('guru.paketsoal.update')}}" method="post">

                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="container">

                            <input type="hidden" name="id" id="id_paket_update" value="">
                            <input type="hidden" name="guru_id" id="guru_id_paket_update" value="">

                            <div class="form-row mb-0 mt-0 pt-0">
                                <div class="form-group col-md-9">
                                    <label for="judul"><b> Judul  : </b></label>
                                    <input type="text" class="form-control" id="judul_paket" value="" name="judul" placeholder="Nama paket soal" style="border-radius:10px;  box-shadow: 3px 0px 5px grey;">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="durasi"> <b> Durasi </b> </label>
                                    <input type="hidden" id="durasi_paket_update" value="">
                                    @if($errors->has('durasi'))
                                                <span class="help-block">{{$errors->first('durasi')}}</span>
                                    @endif
                                    <!-- <input  id="time" class="form-control"  type="time" name="durasi" onchange="ampm(this.value)"  style="border-radius:10px; box-shadow: 3px 0px 5px grey;"> -->
                                    <input  id="time" class="form-control" type="time" name="durasi" style="border-radius:10px; box-shadow: 3px 0px 5px grey;">
                                    <span id="display_time"></span>
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
