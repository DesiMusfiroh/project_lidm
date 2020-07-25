@extends('layouts.layout_guru')

@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item">Guru</a> </li>
        <li class="breadcrumb-item active">Daftar Paket Soal</li>
    </ol>
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
            <div class="card" >
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
                <div class="card-body ">
                <div class="table-inside">
                @if($paketsoal->count() != 0)
                    <table class="table table-striped table-bordered table-sm">
                        <thead class="thead-dark text-center">
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

                                <td class="text-center">#</td>
                                <td class="text-center">

                                <a  href="#" target="_blank" >
                                    <button type="button" class="btn btn-info btn-sm">
                                    <i class="fa fa-download" aria-hidden="true"> Soal</i>
                                        </button>
                                    </a>
                                <a  href="#" target="_blank" >
                                    <button type="button" class="btn btn-secondary btn-sm">
                                    <i class="fa fa-download" aria-hidden="true"> Kunci</i>
                                        </button>
                                    </a>

                                </td>
                                <td class="text-center">
                                <button type="button" class="btn btn-sm btn-warning">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                                Edit
                                </button>
                                    <a href="#" title="Tambah soal">
                                        <button type="button" class="btn btn-success btn-sm">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                    <a href="#" title="Hapus paket soal" class="hapus">
                                        <button type="button" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash fa-sm"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$paketsoal->links()}}
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
</div>
@endsection
