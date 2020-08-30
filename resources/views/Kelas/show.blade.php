@extends('layouts.layout_guru')

@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')
<main class="main">
  <?php use App\KelompokMaster; ?>
    <div>
      {{ Breadcrumbs::render('guru.kelas.show',$kelas) }}
    </div>

    <div class="container-fluid">

        <div class="alert alert-success " role="alert">
            <div class="row">
                <div class="col-md-8">
                    <h5 class="alert-heading"><strong>{{$kelas->nama_kelas}}</strong> </h5>
                    {{$kelas->deskripsi}}
                </div>
                <div class="col-md-4">
                    <div class="col-sm-9 offset-md-3">
                        <strong>Kode Akses Kelas :</strong>
                        <div class="input-group mb-3 mt-1">
                            <input type="text" class="form-control" value="{{$kelas->kode_kelas}}" id="kode_kelas" style="background:#f0f5c1" readonly />
                            <div class="input-group-append">
                            <button type="button" class="btn btn-warning" onclick="copy_text()">Salin</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{session('success')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3"  style="box-shadow: 2px 2px 10px rgba(48, 10, 64, 0.5);" >
                    <div class="card-header" >Daftar Siswa</div>
                    <div class="card-body">
                        @if($anggotakelas->count() != 0)
                        <table class="table table-sm table-striped ">
                            <thead class="thead text-center">
                                <tr>
                                    <td width="30px">No</td>
                                    <td>Nama Siswa</td>
                                    <td width="30px"></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                @foreach ($anggotakelas as $item)
                                    <tr>
                                        <td><?php echo $i; $i++?></td>
                                        <td>{{$item->siswa->nama_lengkap}}</td>
                                        <td>
                                            <a href="#">
                                                <button type="button" class="btn btn-sm btn-info"  data-toggle="popover" title="{{$item->siswa->nama_lengkap}} ({{$item->siswa->nomor_induk}})"
                                                data-content="
                                                {{$item->siswa->jk}}">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </a>
                                        </td>
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
                <div class="card pt-3 pr-3 pl-3 "  style="box-shadow: 2px 2px 10px rgba(48, 10, 64, 0.5);" >

                    <ul class="nav nav-tabs" id="myTab" role="tablist" >
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pertemuan-tab" data-toggle="tab" href="#pertemuan" role="tab" aria-controls="pertemuan" aria-selected="true">Pertemuan</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="kelompok-tab" data-toggle="tab" href="#kelompok" role="tab" aria-controls="kelompok" aria-selected="false">Kelompok</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="messages-tab" data-toggle="tab" href="#tugas" role="tab" aria-controls="tugas" aria-selected="false">Tugas </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="hasil-ujian-tab" data-toggle="tab" href="#hasil-ujian" role="tab" aria-controls="hasil-ujian" aria-selected="false">Hasil Ujian</a>
                        </li>
                    </ul>

                    <div class="tab-content mr-3 ml-3">
                        <!-- pertemuan -->
                        <div class="tab-pane" id="pertemuan" role="tabpanel" aria-labelledby="pertemuan-tab">
                            <div class="mb-3 text-right">
                                <a href="{{route('pertemuan.create',$kelas->id)}}"> <button class="btn btn-success">Buat Pertemuan</button> </a>
                            </div>
                            <div class="row table-inside">
                                @if($pertemuan->count() != 0)
                                <table class="table table-striped table-sm text-center">
                                    <thead class=" thead text-center">
                                        <tr>
                                            <td width="30px">No</td>
                                            <td>Nama Pertemuan</td>
                                            <td>Jadwal</td>
                                            <td>Keterangan</td>
                                            <td align="center">Opsi</td>
                                        </tr>
                                    </thead>

                                    <tbody>
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
                                            <td>
                                            <a href="#">
                                                <button class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                                            </a>
                                            <a href="{{route('pertemuan.show',['kelas_id'=>$kelas->id,'id_pertemuan'=>$item->id])}}"> <button class="btn btn-info btn-sm"><i class="fa fa-eye"></i></button> </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @else
                                    <div class="col-md-12">
                                        <div class="alert alert-warning" role="alert">
                                            Belum ada pertemuan yang dibuat
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row ">{{$pertemuan->links()}}</div>
                        </div>
                        <!-- kelompok  -->
                        <div class="tab-pane" id="kelompok" role="tabpanel" aria-labelledby="kelompok-tab">
                            <div class="mb-3 text-right">
                                <a href="{{route('kelompok.create',$kelas->id)}}"> <button class="btn btn-success">Buat Kelompok</button> </a>
                            </div>
                            <div class="row table-inside">
                            @if($kelompok_master->count() != 0)
                                <table class="table table-striped table-sm text-center">
                                    <thead class=" thead text-center">
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
                                <div class="col-md-12">
                                    <div class="alert alert-warning" role="alert">
                                        Belum ada kelompok yang dibuat
                                    </div>
                                </div>
                            @endif
                            </div>
                            <div class="row ">{{$kelompok_master->links()}}</div>
                        </div>

                        <!-- tugas -->
                        <div class="tab-pane" id="tugas" role="tabpanel" aria-labelledby="tugas-tab">
                            <div class="row">
                                <div class="col-md-9">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist" >
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="tugasindividu-tab" data-toggle="tab" href="#tugasindividu" role="tab" aria-controls="tugasindividu" aria-selected="true">Tugas Individu</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="tugaskelompok-tab" data-toggle="tab" href="#tugaskelompok" role="tab" aria-controls="tugaskelompok" aria-selected="false">Tugas Kelompok</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-0 text-right">
                                        <a href="{{route('tugas.create',$kelas->id)}}"> <button class="btn btn-success">Buat Tugas</button> </a>
                                    </div>
                                </div>
                            </div>
                               
                                <div class="tab-content">
                                <div class="tab-pane active" id="tugasindividu" role="tabpanel" aria-labelledby="tugasindividu-tab">
                                        <div class="row table-inside">
                                        @if($tugas_individu_master->count() != 0)
                                            <table class="table table-striped table-sm">
                                                <thead class=" thead text-center">
                                                    <tr>
                                                        <td width="30px">No</td>
                                                        <td>Nama Tugas</td>
                                                        <td align="center">Opsi</td>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                <?php $i=1; ?>
                                                @foreach ($tugas_individu_master as $item)
                                                    <tr>
                                                        <td  align="center"><?php echo $i; $i++?></td>
                                                        <td>{{$item->nama_tugas}}</td>
                                                        <td  align="center">
                                                        <a href="{{route('showTugasIndividu',$item->id)}}"> <button class="btn btn-info btn-sm"><i class="fa fa-eye"></i></button> </a>
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
                                        <div class="row ">{{$tugas_individu_master->links()}}</div>
                                </div>
                                <div class="tab-pane" id="tugaskelompok" role="tabpanel" aria-labelledby="tugaskelompok-tab">
                                <div class="row table-inside">
                            @if($tugas_kelompok_master->count() != 0)
                                <table class="table table-striped table-sm text-center">
                                    <thead class=" thead text-center">
                                        <tr>
                                            <td width="30px">No</td>
                                            <td>Nama Tugas</td>
                                            <td align="center">Opsi</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php $i=1; ?>
                                    @foreach ($tugas_kelompok_master as $item)
                                        <tr>
                                            <td><?php echo $i; $i++?></td>
                                            <td>{{$item->nama_tugas}}</td>

                                            <td>
                                            <a href="{{route('showTugasKelompok',$item->id)}}"> <button class="btn btn-info btn-sm"><i class="fa fa-eye"></i></button> </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="col-md-12">
                                    <div class="alert alert-warning" role="alert">
                                        Belum ada tugas kelompok yang dibuat
                                    </div>
                                </div>
                            @endif
                            </div>
                            <div class="row ">{{$tugas_kelompok_master->links()}}</div>
                                </div>
                                </div>
                        </div>

                        <!-- hasil ujian -->
                        <div class="tab-pane" id="hasil-ujian" role="tabpanel" aria-labelledby="hasil-ujian-tab">
                            <div class="col-md-12">
                                <div class="alert alert-warning" role="alert">
                                   Belum ada hasil ujian 
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
  $(function () {
    $('#myTab li:first-child a').tab('show')
  })
    $("#start").hide();

  function copy_text() {
        document.getElementById("kode_kelas").select();
        document.execCommand("copy");
        swal({
            title: "Kode Akses Ujian Berhasil di Copy !",
            icon: "success",
        });
    }
</script>
@endsection
