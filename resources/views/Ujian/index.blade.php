@extends('layouts.layout_guru')
@section('title','Ujian')
@section('content')


<div class="container">
  <div>
    {{ Breadcrumbs::render('guru.ujian.index') }}
  </div>
    <div class="row justify-content-center">
        <div class="col-md-12" >
            <div class="card">
                <div class="card-header">
                  <strong style="font-size:18px"> Daftar Riwayat Ujian </strong>
                </div>
                
                <div class="card-body pb-0">
                  @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                  @endif
                @if($ujian->count() != 0)
                <div class="table-inside">
                    <table class="table table-striped table-bordered table-sm">
                        <thead class="text-center bg-dark" style="color:white;">
                          <tr>
                            <th style="width:50px">No</th>
                            <th>Nama Ujian</th>
                            <th>Kelas</th>
                            <th>Paket Soal</th>
                            <th>Waktu Mulai</th>
                            <th width="140px">Aksi</th>
                          </tr>
                        </thead>
                        <tbody class="text-center">
                        @foreach($ujian as $item)
                        <tr>
                          <th scope="row" class="text-center">{{$loop->iteration}}</th>
                          <td>{{$item->nama_ujian}}</td>
                          <td>{{$item->kelas->nama_kelas}}</td>
                          <td>{{$item->paket_soal->judul}}</td>
                          <td>{{$item->waktu_mulai}}</td>
                          <td> <a href="{{route('guru.ujian.show',$item->id)}}" class="btn  btn-sm btn-info" title="Lihat"> <i class="fa fa-eye"></i> </a> 
                          <button type="button" class="btn  btn-sm  btn-warning" data-toggle="modal" data-target=".update_modal_ujian"
                                    id="update"
                                    data-ujian_id_update="{{ $item->id }}"
                                    data-kelas_id_update="{{ $item->kelas_id }}"
                                    data-guru_id_update="{{ $item->guru_id }}"
                                    data-paket_soal_id_update="{!! $item->paket_soal_id!!}"
                                    data-nama_ujian_update="{!! $item->nama_ujian !!}"
                                    data-waktu_mulai_update="{!! $item->waktu_mulai !!}"
                                    data-status_update="{!! $item->statu !!}"
                                    data-isdelete_update="{!! $item->isdelete !!}"
                                     title="Ubah Ujian">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                          </button>
                          <a href="#" title="Hapus Ujian" class="hapus" ujian_id="{{$item->id}}" nama_ujian="{{$item->nama_ujian}}">
                                        <button type="button" class="btn btn-sm btn-danger ">
                                            <i class="fa fa-trash fa-sm"></i>
                                        </button>
                                    </a>
                          
                          </td>
                        
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
                <div class=" row justify-content-right"> <div class="col-md-12"> {{$ujian->links()}}</div></div>
                @else
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong> Belum ada ujian yang di buat. Silahkan buat ujian baru!</strong>
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

<script>

$(document).ready(function(){
    $(document).on('click','#update', function(){
        var ujian_id_update          = $(this).data('ujian_id_update');
        var kelas_id_update          = $(this).data('kelas_id_update');
        var guru_id_update           = $(this).data('guru_id_update');
        var paket_soal_id_update     = $(this).data('paket_soal_id_update');
        var nama_ujian_update        = $(this).data('nama_ujian_update');
        var waktu_mulai_update       = $(this).data('waktu_mulai_update');
        var status_update            = $(this).data('status_update');
        var isdelete_update          = $(this).data('isdelete_update');
        $('#ujian_id_update ').val(ujian_id_update );
        $('#kelas_id_update').val(kelas_id_update);
        $('#guru_id_update').val(guru_id_update);
        $('#paket_soal_id').val(paket_soal_id_update );
        $('#nama_ujian').val(nama_ujian_update );
        $('#status_update').val(status_update );
        $('#isdelete_update').val(isdelete_update );
        $('#waktu_mulai').val(waktu_mulai_update );
    });
});
 $('.hapus').click(function(){

var ujian_id = $(this).attr('ujian_id');
var nama_ujian = $(this).attr('nama_ujian');
swal({
  title: "Yakin?",
  text: "Menghapus ujian "+nama_ujian+ " ?",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    window.location = 'ujian/delete/'+ujian_id;
  }
});
});
</script>
@stop
<!-- update Modal (ujian)-->
<div class="modal fade update_modal_ujian"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
              <div class="modal-header ">
                <h5 class="modal-title " id="exampleModalLabel"> <strong>Edit Ujian</strong> </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
                <form action="{{route('guru.ujian.update')}}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="container">

                            <input type="hidden" name="id" id="ujian_id_update" value="">
                            <input type="hidden" name="kelas_id" id="kelas_id_update" value="">
                            <input type="hidden" name="guru_id" id="guru_id_update" value="">       
                            <input type="hidden" name="status" id="status_update" value="">
                            <input type="hidden" name="isdelete" id="isdelete_update" value="">

                            <div class="form-row mb-0 mt-0 pt-0">
                                <div class="form-group col-md-12">
                                <label for="judul"><b> Paket Soal : </b></label>
                                <select class="form-control"  style="border-radius:10px;  box-shadow: 3px 0px 5px grey;" id="paket_soal_id" name="paket_soal_id" value="" >
                                  <option disabled selected></option>
                                  @foreach($paketsoal as $item)
                                  <option value="{{$item->id}}">{{$item->judul}}</option>
                                  @endforeach

                                </select>
                          
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="judul"><b> Nama Ujian : </b></label>
                                    <input type="text" class="form-control" id="nama_ujian" value="" name="nama_ujian"  style="border-radius:10px;  box-shadow: 3px 0px 5px grey;">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="waktu_mulai"> <b> Waktu Mulai</b> </label>
                                    <input  id="waktu_mulai" class="form-control" type="datetime-local" name="waktu_mulai" style="border-radius:10px; box-shadow: 3px 0px 5px grey;">
                                    <span> *Abaikan jika tidak ingin mengubah waktu</span>
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
