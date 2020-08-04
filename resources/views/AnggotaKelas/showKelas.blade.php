@extends('layouts.layout_siswa')

@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')
<main class="main">
    <div>
        {{ Breadcrumbs::render('showkelas',$kelas) }}
    </div>
    <div class="container-fluid">

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
                        <table class="table table-striped">
                            <thead class="thead-dark thead">
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
                <div class="card pt-3 pr-3 pl-3 pb-3">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pertemuan-tab" data-toggle="tab" href="#pertemuan" role="tab" aria-controls="pertemuan" aria-selected="true">Pertemuan</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="kelompok-tab" data-toggle="tab" href="#kelompok" role="tab" aria-controls="kelompok" aria-selected="false">Kelompok</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="messages-tab" data-toggle="tab" href="#tugas" role="tab" aria-controls="tugas" aria-selected="false">Tugas</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="hasil-ujian-tab" data-toggle="tab" href="#hasil-ujian" role="tab" aria-controls="hasil-ujian" aria-selected="false">Hasil Ujian</a>
                        </li>
                    </ul>

                    <div class="tab-content mr-3 ml-3">
                        <div class="tab-pane active" id="pertemuan" role="tabpanel" aria-labelledby="pertemuan-tab">
                            <div class="row">
                                <table class="table table-striped table-bordered table-sm">
                                    <thead class="thead-dark text-center">
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
                                            <td>Sedang Berlangsung</td>
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
                        </div>
                        <div class="tab-pane" id="kelompok" role="tabpanel" aria-labelledby="kelompok-tab">

                          <h3 class="text-center">Kelompok saya</h3>
                          <div class="row">
                            <div class="card-body"><h5 class="card-title">{{$kelompok_saya->nama_kelompok}}</h5>
                              <table class="mb-0 table  table-hover">
                                  <thead class="thead-dark">
                                  <tr>
                                      <th>No</th>
                                      <th>Nama</th>

                                  </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($anggota_kelompok as $item)
                                  <tr>
                                      <th scope="row">{{$loop->iteration}}</th>
                                      <td>{{$item->anggota_kelas->siswa->nama_lengkap}}</td>
                                  </tr>
                                  @endforeach
                                  </tbody>
                              </table>
                            </div>
                          </div>

                        </div>
                        <div class="tab-pane" id="tugas" role="tabpanel" aria-labelledby="tugas-tab">
                            tugas
                        </div>
                        <div class="tab-pane" id="hasil-ujian" role="tabpanel" aria-labelledby="hasil-ujian-tab">
                            <div class="table-inside">
                            @if($hasil_ujian->count() != 0)
                            <table class="table table-striped table-bordered table-sm" >
                                    <thead class="thead-dark text-center">
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
                                                <a href="">
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
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong> Belum ada ujian yang di telah dikerjakan. </strong>
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
        </div>

    </div>
</main>



<script>
  $(function () {
    $('#myTab li:last-child a').tab('show')
  })
</script>
@endsection
