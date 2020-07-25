@extends('layouts.layout_guru')

@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{route('guru.kelas')}}">Kelas</a> </li>
        <li class="breadcrumb-item active">{{$kelas->nama_kelas}}</li>
    </ol>
    <div class="container-fluid">

        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">{{$kelas->nama_kelas}}</h4>
            <p>{{$kelas->deskripsi}}</p>
            <hr>
            <div class="mb-0 text-right">
                Kode Akses Kelas : <strong>{{$kelas->kode_kelas}}</strong>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">Daftar Siswa</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead class="thead-dark thead">
                                <tr>
                                    <td>No</td>
                                    <td>Nama Siswa</td>
                                </tr>
                            </thead>
                        </table>
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
                            <div class="mb-3 text-right">
                                <a href="{{route('pertemuan.create',$kelas->id)}}"> <button class="btn btn-success">Buat Pertemuan</button> </a>
                            </div>
                            <div class="row">
                                <table class="table table-striped">
                                    <thead class="thead-dark thead">
                                        <tr>
                                            <td width="30px">No</td>
                                            <td>Nama Pertemuan</td>
                                            <td>Waktu Mulai</td>
                                            <td>Opsi</td>
                                        </tr>
                                    </thead>
                                    @if($pertemuan->count() != 0)
                                    <tbody>
                                    <?php $i=1; ?>
                                    @foreach ($pertemuan as $item)
                                        <tr>
                                            <td><?php echo $i; $i++?></td>
                                            <td>{{$item->nama_pertemuan}}</td>
                                            <td>{{$item->waktu_mulai}}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    @else 
                                    <tbody>
                                    <div class="alert alert-warning" role="alert">
                                        Belum ada pertemuan yang dibuat
                                    </div>
                                    </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="kelompok" role="tabpanel" aria-labelledby="kelompok-tab">
                            kelompok
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