@extends('layouts.layout_guru')

@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')
<main class="main">
    <div>
      {{ Breadcrumbs::render('pertemuan.show',$pertemuan->kelas,$pertemuan) }}
    </div>
    <div class="container-fluid">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">{{$pertemuan->nama_pertemuan}}</h4>
            <p>{{$pertemuan->deskripsi}}<br/>
                {{$pertemuan->status}}
            </p>
            <hr>
            <div class="mb-0 text-right">
                Nama Kelas : <strong>{{$kelas->nama_kelas}}</strong>
            </div>
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
                <div class="card pt-3 pr-3 pl-3 pb-3">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <!-- <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pertemuan-tab" data-toggle="tab" href="#pertemuan" role="tab" aria-controls="pertemuan" aria-selected="true">Pertemuan</a>
                        </li> -->
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="kelompok-tab" data-toggle="tab" href="#kelompok" role="tab" aria-controls="kelompok" aria-selected="false">Kelompok</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link " id="messages-tab" data-toggle="tab" href="#tugas" role="tab" aria-controls="tugas" aria-selected="false">Tugas</a>
                        </li>
                    </ul>

                    <div class="tab-content mr-3 ml-3">
                        <!-- <div class="tab-pane active" id="pertemuan" role="tabpanel" aria-labelledby="pertemuan-tab">
                            <div class="mb-3 text-right">
                            Text
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="alert alert-warning" role="alert">
                                            Belum ada pertemuan yang dibuat
                                        </div>
                                    </div>
                            </div>
                        </div>  -->
                        <div class="tab-pane active" id="kelompok" role="tabpanel" aria-labelledby="kelompok-tab">
                            <div class="mb-3 text-right">
                                <a href="#"> <button class="btn btn-success">Buat Kelompok</button> </a>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-warning" role="alert">
                                            Belum ada kelompok yang dibuat
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tugas" role="tabpanel" aria-labelledby="tugas-tab">
                        <div class="row">
                                <div class="col-md-12">
                                        <div class="alert alert-warning" role="alert">
                                            Belum ada tugas yang dibuat
                                        </div>
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
    $('#myTab li:last-child a').tab('show')
  })
</script>

@endsection
