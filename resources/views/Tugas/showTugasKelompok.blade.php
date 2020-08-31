@extends('layouts.layout_guru')

@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')
<main class="main">
    <div>
        {{ Breadcrumbs::render('showTugasKelompok',$tugas_kelompok_master->kelas, $tugas_kelompok_master) }}
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <strong style="font-size:18px"> DAFTAR TUGAS </strong>
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
                        <table class="mb-0 table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Kelompok</th>
                                <th>Tugas</th>
                                <th>Nilai</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($kumpul_tugas_kelompok as $item)
                            <tr>
                                <td scope="row">{{$loop->iteration}}</th>
                                <td>{{$item->kelompok->nama_kelompok}}</td>
                                @if($item->tugas == null)
                                <td> Belum mengumpulkan tugas</td>
                                @else
                                <td><a href="{{url('tugas/'.$item->tugas)}}"><button class="btn btn-info btn-sm">Download <i class="fa fa-download"></i></button></a></td>
                                @endif
                                <td>{{number_format($item->nilai,0)}}</td>
                                @if($item->nilai == 0)
                                <td>
                                <button type="submit" class="btn btn-info" data-toggle="modal" data-target=".ubah_modal_beriNilai"
                                            id="update"
                                            data-kumpul_tugas_kelompok_id_update = "{{ $item->id }}"
                                            data-tugas_kelompok_id_update = "{{ $item->tugas_kelompok_id }}"
                                            data-kelompok_id_update = "{{ $item->kelompok_id }}"
                                            data-tugas_update = "{{ $item->tugas }}"
                                            data-nilai_update = "{{ $item->nilai }}"

                                            style="box-shadow: 3px 2px 5px grey; margin:5px;">Beri Nilai</button>
                                
                                                     
                                </td>
                                @else
                                <td>
                                <button type="submit" class="btn btn-info" data-toggle="modal" data-target=".ubah_modal_beriNilai"
                                            id="update"
                                            data-kumpul_tugas_kelompok_id_update = "{{ $item->id }}"
                                            data-tugas_kelompok_id_update = "{{ $item->tugas_kelompok_id }}"
                                            data-kelompok_id_update = "{{ $item->kelompok_id }}"
                                            data-tugas_update = "{{ $item->tugas }}"
                                            data-nilai_update = "{{ $item->nilai }}"

                                            style="box-shadow: 3px 2px 5px grey; margin:5px;">Ubah Nilai</button>
                                
                                </td>
                                @endif

                            </tr>
                            @endforeach
                            </tbody>
                        </table>

  </div>

  </div>

  </div>
</main>
<script>
    $(document).ready(function(){
        $(document).on('click','#update', function(){
        var kumpul_tugas_kelompok_id_update                 = $(this).data('kumpul_tugas_kelompok_id_update');
        var tugas_kelompok_id_update                        = $(this).data('tugas_kelompok_id_update');
        var kelompok_id_update                              = $(this).data('kelompok_id_update');
        var tugas_update                                    = $(this).data('tugas_update');
        var nilai_update                                    = $(this).data('nilai_update');
       
        $('#kumpul_tugas_kelompok_id_update').val(kumpul_tugas_kelompok_id_update);
        $('#tugas_kelompok_id_update').val(tugas_kelompok_id_update);
        $('#kelompok_id_update').val(kelompok_id_update);
        $('#tugas_update').val(tugas_update);
        $('#nilai_update').val(nilai_update);


        });

    });
    </script>
@stop
<!-- Create Modal (Tugas Kelompok)-->
<div class="modal fade ubah_modal_beriNilai"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title " id="exampleModalLabel">Beri Nilai </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{route('beriNilaiKelompok')}}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PATCH')
                    <div class="modal-body">
                        <div class="container">

                            <div class="form-group">
                            <input type="hidden" name="id" id="kumpul_tugas_kelompok_id_update" value=""> 
                            <input type="hidden" name="tugas_kelompok_id" id="tugas_kelompok_id_update" value=""> 
                            <input type="hidden" name="kelompok_id" id="kelompok_id_update" value=""> 
                            <input type="hidden" name="file" id="tugas_update" value=""> 
                                <label for="alamat"> Masukkan Nilai </label>
                                <input type="number" class="form-control"  min="0" max="100"id="nilai_update" name="nilai"  >
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
