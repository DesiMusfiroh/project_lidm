@extends('layouts.layout_guru')

@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')
<main class="main">
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
                    <div class="mb-0 text-right">
                    Kode Akses Kelas : <strong>{{$kelas->kode_kelas}}</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3"  style="box-shadow: 2px 2px 10px rgba(48, 10, 64, 0.5);" >
                    <div class="card-header" >Daftar Siswa</div>
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
                <div class="card pt-3 pr-3 pl-3 pb-3"  style="box-shadow: 2px 2px 10px rgba(48, 10, 64, 0.5);" >

                    <ul class="nav nav-tabs" id="myTab" role="tablist" >
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
                            <div class="mb-3 text-right">
                                <a href="{{route('pertemuan.create',$kelas->id)}}"> <button class="btn btn-success">Buat Pertemuan</button> </a>
                            </div>
                            <div class="row">
                                @if($pertemuan->count() != 0)
                                <table class="table table-striped">
                                    <thead class="thead-dark thead">
                                        <tr>
                                            <td width="30px">No</td>
                                            <td>Nama Pertemuan</td>
                                            <td>Jadwal</td>
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
                        </div>
                        <div class="tab-pane" id="kelompok" role="tabpanel" aria-labelledby="kelompok-tab">
                            <div class="card-body"><h5 class="card-title">Buat Kelompok</h5>
                                <form class="" action="{{route('storeKelompok')}}" method="post">
                                @csrf
                                    <input type="hidden" name="kelas_id" value="{{$kelas->id}}">
                                    <div class="position-relative form-group">
                                      <label for="jumlah_kelompok" class="">Jumlah Kelompok</label>
                                      <input name="jumlah_kelompok" id="jumlah_elompok" type="number" class="form-control">
                                    </div>
                                    <div class="position-relative form-group">
                                      <label for="deskripsiKelompok" class="">Deskripsi Kelompok</label>
                                      <textarea name="deskripsi" id="deskripsiKelompok" class="form-control"> </textarea>
                                    </div>
                                    <button class="mt-1 btn btn-primary" type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane" id="tugas" role="tabpanel" aria-labelledby="tugas-tab">
                            tugas
                        </div>
                        <div class="tab-pane" id="hasil-ujian" role="tabpanel" aria-labelledby="hasil-ujian-tab">
                            hasil ujian
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
