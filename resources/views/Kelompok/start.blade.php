@extends('layouts.layout_ruang')

@section('content')

<?php use App\AnggotaKelompok; ?>
<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-heavy-rain mt-3 mr-3 ml-3 pt-3 pb-2 pr-3 pl-3">
                <div class="row">
                    <div class="col text-center">
                    <h4><strong>Diskusi {{$kelompok_master->deskripsi}} </strong> </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        @foreach($kelompok as $item)
        <div class="col-md-3">
            <div class="card">
            <h5 class="card-header">{{$item->nama_kelompok}}</h5>
            <div class="card-body">
                <h5 class="card-title">Anggota Kelompok</h5>
                <?php $anggota_kelompok = AnggotaKelompok::where('kelompok_id',$item->id)->get(); ?>
                <ul>
                @foreach($anggota_kelompok as $item)
                <li class="card-text">{{$item->anggota_kelas->siswa->nama_lengkap}}</li>
                @endforeach
                </ul>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
            </div>
        </div>
        @endforeach
    </div>

    
    <div id="leave">
        <a href=""><button class="btn-danger btn"><i class="fa fa-times" style="margin-right:10px"></i> Keluar</button> </a>
    </div> 

    <div id="end">
        <button class="btn-danger btn" id="akhiri_diskusi_kelompok"> Akhiri Diskusi Kelompok</button>
    </div>

</div>

<script>
    $(document).on('click','#akhiri_diskusi_kelompok', function(){       
        swal({
            title: "Akhiri diskusi kelompok",
            text: "kembali ke ruang pertemuan ",
            icon: "warning",
            buttons: true,
            dangerMode: false,
        })
            .then((endDiskusi) => {
            if (endDiskusi) {
            window.location = "/guru/kelas/diskusi/end/"+<?php echo $pertemuan->id ?>+"/"+<?php echo $kelompok_master->id ?>;
            }
        });
    });
</script>
@endsection