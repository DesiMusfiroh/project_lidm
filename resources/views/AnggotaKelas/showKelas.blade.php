@extends('layouts.layout_siswa')

@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')
<main class="main">
    <div>
        {{ Breadcrumbs::render('siswa.kelas.show',$kelas) }}
    </div>
    <div class="container-fluid">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif


        <div class="alert alert-success" role="alert">
            <h5 class="alert-heading"><strong>{{$kelas->nama_kelas}}</strong> </h5>
            <p>{{$kelas->deskripsi}}</p>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">Daftar Siswa</div>
                    <div class="card-body">
                        @if($anggotakelas->count() != 0)
                        <table class="table table-striped table-sm">
                            <thead class="thead-dark thead text-center" style="background-color:#393A3C; color:white; font-weight:bold">
                                <tr>
                                    <td width="40px">No</td>
                                    <td>Nama Siswa</td>
                                    <td width="30px"></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                @foreach ($anggotakelas as $item)
                                    <tr>
                                        <td class="text-center"><?php echo $i; $i++?></td>
                                        <td>{{$item->siswa->nama_lengkap}}</td>
                                        <td><a href=""><button class="btn btn-sm btn-info"><i class="fa fa-eye"></i></button></a> </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="col-md-12">
                            <div class="alert alert-warning" role="alert">
                                Belum ada siswa yang mengikuti kelas ini
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card pt-3 pr-3 pl-3 pb-0">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pertemuan-tab" data-toggle="tab" href="#pertemuan" role="tab" aria-controls="pertemuan" aria-selected="true">Pertemuan</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="kelompok-tab" data-toggle="tab" href="#kelompok" role="tab" aria-controls="kelompok" aria-selected="false">Kelompok</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="tugas-tab" data-toggle="tab" href="#tugas" role="tab" aria-controls="tugas" aria-selected="false">Tugas
                            <span class="badge badge-pill badge-info">New</span></a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="hasil-ujian-tab" data-toggle="tab" href="#hasil-ujian" role="tab" aria-controls="hasil-ujian" aria-selected="false">Hasil Ujian</a>
                        </li>
                    </ul>

                    <div class="tab-content mr-3 ml-3">
                        <!-- pertemuan -->
                        <div class="tab-pane active" id="pertemuan" role="tabpanel" aria-labelledby="pertemuan-tab">
                            <div class="row table-inside">
                                <table class="table table-striped table-sm" >
                                    <thead class="thead-dark text-center" style="background-color:#393A3C; color:white; font-weight:bold">
                                        <tr>
                                            <td>No</td>
                                            <td>Nama Pertemuan</td>
                                            <td>Waktu Mulai</td>
                                            <td>Status</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    @if($pertemuan->count() != 0)
                                    <tbody class="text-center">
                                    <?php $i=1; ?>
                                    @foreach ($pertemuan as $item)
                                        <tr>
                                            <td><?php echo $i; $i++?></td>
                                            <td>{{$item->nama_pertemuan}}</td>
                                            <td>{{$item->waktu_mulai}}</td>
                                            @if($item->status == 0)
                                            <td>Belum dimulai</td>
                                            @elseif($item->status == 1)
                                            <td>Berlangsung</td>
                                            @elseif($item->status ==2)
                                            <td>Selesai</td>
                                            @endif
                                            <!--Aksi-->
                                            <td>
                                            <a href="{{route('pertemuanSiswa.show',['kelas_id'=>$kelas->id,'id_pertemuan'=>$item->id])}}"> <button class="btn btn-info btn-sm"><i class="fa fa-eye"></i></button> </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    @else
                                    <tbody>
                                    <div class="alert alert-warning" role="alert">
                                        Belum ada pertemuan
                                    </div>
                                    </tbody>
                                    @endif
                                </table>
                            </div>
                            <div class="row justify-content-center">{{$pertemuan->links()}}</div>
                        </div>
                        <!-- kelompok -->
                        <div class="tab-pane" id="kelompok" role="tabpanel" aria-labelledby="kelompok-tab">
                            <div class="row table-inside">
                            @if($kelompok_master->count() != 0)
                                <table class="table table-striped table-sm text-center" >
                                    <thead class="thead text-center" style="background-color:#393A3C; color:white; font-weight:bold">
                                        <tr>
                                            <td width="30px">No</td>
                                            <td>Deskripsi Kelompok</td>
                                            <td>Jumlah Kelompok</td>
                                            <td align="center">Opsi</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php $i=1; ?>
                                    @foreach ($kelompok_master as $item)
                                        <tr>
                                            <td><?php echo $i; $i++?></td>
                                            <td>{{$item->deskripsi}}</td>
                                            <td>{{$item->jumlah_kelompok}}</td>
                                            <td>
                                            <a href="{{route('kelompok.show',$item->id )}}"> <button class="btn btn-info btn-sm"><i class="fa fa-eye"></i></button> </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-warning" role="alert">
                                    Belum ada kelompok dalam kelas ini
                                </div>
                            @endif
                            </div>
                            <div class="row table-inside">
                            <center>Kelompok yang saya ikuti</center>
                            @if($kelompok_saya_ikuti->count() != 0)
                                <table class="table table-striped table-sm text-center" >
                                    <thead class="thead text-center" style="background-color:#393A3C; color:white; font-weight:bold">
                                        <tr>
                                            <td width="30px">No</td>
                                            <td>Nama kelompok</td>

                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php $i=1; ?>
                                    @foreach ($kelompok_saya_ikuti as $item)
                                        <tr>
                                            <td><?php echo $i; $i++?></td>
                                            <td>{{$item->nama_kelompok}}</td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-warning" role="alert">
                                    Belum ada kelompok dalam kelas ini
                                </div>
                            @endif
                            </div>
                        </div>
                        <!-- tugas  -->
                        <div class="tab-pane" id="tugas" role="tabpanel" aria-labelledby="tugas-tab">
                          <a href="{{route('semuaTugas',$kelas->id)}}"><button type="button" name="button" class="btn btn-primary"> Tugas selesai</button></a> 
                        <div class="row table-inside">
                        @if($kumpul_tugas_individu->count() != 0)
                                <table class="table table-striped table-sm" >
                                    <thead class="thead-dark text-center" style="background-color:#393A3C; color:white; font-weight:bold">
                                        <tr>
                                            <td>No</td>
                                            <td>Nama Tugas</td>
                                            <td>Deadline</td>
                                            <td> Tugas </td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    <?php $i=1; ?>
                                    @foreach ($kumpul_tugas_individu as $item)
                                        <tr>
                                            <td><?php echo $i; $i++?></td>
                                            <td>{{$item->tugas_individu->tugas_individu_master->nama_tugas}}</td>
                                            <td>{{$item->tugas_individu->tugas_individu_master->deadline}}</td>
                                            <!--Aksi-->
                                            @if($item->tugas == null)
                                            <td>
                                            <form action="{{route('serahTugas')}}" method="post" enctype="multipart/form-data" >
                                            @csrf
                                            @method('PATCH')

                                            <input type="hidden" name="id"  value="{{$item->id}}">
                                            <input type="file" name="tugas">

                                            <td>

                                                <button class="btn btn-sm btn-outline-secondary" type="submit" id="simpan">Serahkan</button>
                                            </td>
                                            </div>
                                        	</form>
                                            @else
                                            <td> Diserahkan </td>
                                            <td>

                                            <button type="submit" class="btn btn-info" data-toggle="modal" data-target=".ubah_modal_serahTugasIndividu"
                                            id="update"
                                            data-kumpul_tugas_individu_id_update = "{{ $item->id }}"
                                            data-tugas_individu_id_update = "{{ $item->tugas_individu_id }}"
                                            data-anggota_kelas_id_update = "{{ $item->anggota_kelas_id }}"
                                            data-tugas_update = "{{ $item->tugas }}"
                                            data-nilai_update = "{{ $item->nilai }}"

                                            style="box-shadow: 3px 2px 5px grey; margin:5px;">Ubah Tugas</button>

                                            </td>
                                            @endif

                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                    @else
                                    <tbody>
                                    <div class="alert alert-warning" role="alert">
                                        Belum ada tugas
                                    </div>
                                    </tbody>
                                    @endif
                                </table>
                            <div class="row justify-content-center">{{$kumpul_tugas_individu->links()}}</div>
                        </div>
                        <div class="row table-inside">
                            <center>Tugas Kelompok saya</center>
                            @if($kumpul_tugas_kelompok->count() != 0)
                                <table class="table table-striped table-sm text-center" >
                                    <thead class="thead text-center" style="background-color:#393A3C; color:white; font-weight:bold">
                                        <tr>
                                            <td width="30px">No</td>
                                            <td>Nama tugas</td>
                                            <td></td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php $i=1; ?>
                                    @foreach ($kumpul_tugas_kelompok as $item)
                                        <tr>
                                            <td><?php echo $i; $i++?></td>
                                            <td>{{$item->tugas_kelompok->tugas_kelompok_master->nama_tugas}}</td>
                                            @if($item->tugas == null)
                                            <form action="{{route('serahTugasKelompok')}}" method="post" enctype="multipart/form-data" >
                                            @csrf
                                            @method('PATCH')


                                            <td>
                                            <input type="hidden" name="id"  value="{{$item->id}}">
                                            <input type="file" name="tugas">

                                                <button class="btn btn-sm btn-outline-secondary" type="submit" id="simpan">Serahkan</button>
                                            </td>
                                            </div>
                                        	</form>
                                        	@else
                                            <td> Diserahkan </td>
                                            @endif

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-warning" role="alert">
                                    Belum ada kelompok dalam kelas ini
                                </div>
                            @endif
                            </div>
                    	</div>

                        <!-- hasil ujian  -->
                        <div class="tab-pane" id="hasil-ujian" role="tabpanel" aria-labelledby="hasil-ujian-tab">
                            <div class="row table-inside">
                            @if($hasil_ujian->count() != 0)
                                <table class="table table-striped table-sm" >
                                    <thead class="thead text-center" style="background-color:#393A3C; color:white; font-weight:bold">
                                        <tr>
                                            <th scope="col" style="width:50px">No</th>
                                            <th scope="col" >Nama Ujian </th>
                                            <th scope="col" >Tanggal Ujian </th>
                                            <th scope="col" >Nilai Ujian </th>
                                            <th scope="col" >Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; ?>
                                        @foreach ($hasil_ujian as $item)
                                        <tr>
                                            <td scope="row" class="text-center"><?php echo $i; $i++; ?></td>
                                            <?php $i++; ?>
                                            <td >{{$item->ujian->nama_ujian}}</td>
                                            <td class="text-center"> {{date("d-m-Y",strtotime($item->ujian->waktu_mulai))}} </td>
                                            <td class="text-center">  </td>
                                            <td class="text-center">
                                                <a href="{{route('hasilUjian',$item->id)}}">
                                                    <button type="button" class="btn btn-info btn-sm">
                                                        <i class="fa fa-eye fa-sm"></i> Detail
                                                    </button>
                                                </a>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                    <div class="row">
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong> Belum ada hasil ujian </strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
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
</main>



<script>
  $(function () {
    $('#myTab li:first-child a').tab('show')
  })
  $("#start").hide();



</script>
<!--edit essay-->
<script>
    $(document).ready(function(){
        $(document).on('click','#update', function(){
        var kumpul_tugas_individu_id_update                 = $(this).data('kumpul_tugas_individu_id_update');
        var tugas_individu_id_update                        = $(this).data('tugas_individu_id_update');
        var anggota_kelas_id_update                         = $(this).data('anggota_kelas_id_update');
        var tugas_update                                    = $(this).data('tugas_update');
        var nilai_update                                    = $(this).data('nilai_update');

        $('#kumpul_tugas_individu_id_update').val(kumpul_tugas_individu_id_update);
        $('#tugas_individu_id_update').val(tugas_individu_id_update);
        $('#anggota_kelas_id_update').val(anggota_kelas_id_update);
        $('#tugas_update').val(tugas_update);
        $('#nilai_update').val(nilai_update);


        });

    });
    </script>
    <!--edit-->
@endsection

<!-- Create Modal (Tugas Individu)-->
<div class="modal fade ubah_modal_serahTugasIndividu"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title " id="exampleModalLabel">Ubah Tugas </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{route('ubahTugas')}}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PATCH')
                    <div class="modal-body">
                        <div class="container">

                            <div class="form-group">
                            <input type="hidden" name="id" id="kumpul_tugas_individu_id_update" value="">
                            <input type="hidden" name="tugas_individu_id" id="tugas_individu_id_update" value="">
                            <input type="hidden" name="anggota_kelas_id" id="anggota_kelas_id_update" value="">
                            <input type="hidden" name="nilai" id="nilai_update" value="">
                                <label for="alamat"> Pilih Tugas </label>
                                <input type="file" class="form-control" id="tugas_update" name="tugas"  >
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
