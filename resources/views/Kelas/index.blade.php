@extends('layouts.layout_guru')

@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')
<main class="main">
    <div>
      {{ Breadcrumbs::render('guru.kelas') }}
    </div>

    <div class="container-fluid">
<!-- 
    <div class="card" >
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <strong style="font-size:18px"> Daftar Kelas </strong>
                </div>
            </div>
        </div>

        <div class="card-body pb-0">

            @if($kelas->count() != 0)
            <div class="row">
                @foreach ($kelas as $item)
                    <div class="col-md-4">
                        <div class="alert alert-success mb-3">
                            <h5 class="card-title">{{$item->nama_kelas}}</h5>
                            <p >{{$item->deskripsi}}</p>
                            <div class="text-right"><a href="{{route('guru.kelas.show',$item->id)}}" class="btn btn-info"><i class="metismenu-icon pe-7s-monitor mr-1"></i> Masuk</a></div>
                        </div>
                    </div>
                @endforeach
            </div>
            @else
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong> Belum ada kelas yang di buat. Silahkan buat kelas baru !</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

        </div>
    </div> -->

    <div class="alert alert-success pb-1 pt-2" role="alert">
    <h5><strong>Daftar Kelas</strong> </h5>
    </div>
    @if($kelas->count() != 0)
    <?php
        $anggota=0;
    ?>
        <div class="row">
            @foreach ($kelas as $item)
            <div class="col-md-4">
            <div class="card mb-3 ">
                <div class="card-body ">
                    <h5 class="card-title">{{$item->nama_kelas}}</h5> <hr class="mb-0 mt-0 pt-0 pb-0">
                    <p class="card-text">{{$item->deskripsi}}</p>
                    <div class="row">
                  
                        <div class="col-md-7"> <div class="alert alert-sm alert-warning mb-0 mt-0 pb-0 pt-0"> Jumlah Siswa : <?php echo number_format($anggota);?>  </div> </div>
                        <div class="col-md-5"><div class="text-right"><a href="{{route('guru.kelas.show',$item->id)}}" class="btn btn-info"><i class="metismenu-icon pe-7s-monitor mr-1"></i> Masuk</a></div></div>
                    </div>
                    
                </div>
            </div>
            </div>
            @endforeach
        </div>
    @else
    <div class="col-md-12">
        <div class="alert alert-warning" role="alert">
            Belum ada kelas yang dibuat
        </div>
    </div>
    @endif
    </div>
</main>
@endsection
