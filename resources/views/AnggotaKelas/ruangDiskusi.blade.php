@extends('layouts.layout_ruang')

@section('content')
<style>

</style>

<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-heavy-rain mt-3 mr-3 ml-3 pt-3 pb-2 pr-3 pl-3">
                <div class="row">
                    <div class="col text-center">
                    <h4><strong>Ruang Diskusi</strong> </h4>
                    </div>
                </div>
                <div class="row">
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js')}}"></script>
<script>
    Echo.private('endDiskusiChannel.{{ $kelompok->kelompok_master->kelas->id}}')
    .listen('EndDiskusi', (e) => {
        console.log(e);
        swal({
            title: "Diskusi kelompok telah berakhir",
            text: "Silahkan kembali ke ruang pertemuan",
            icon: "info",
            buttons: true,
            dangerMode: false,
        })
            .then((endDiskusi) => {
            if (endDiskusi) {
            window.location = "/siswa/kelas/pertemuan/ruang/"+<?php echo $kelompok->kelompok_master->kelas->id ?>+"/"+<?php echo $pertemuan->id ?>;
            }
        });
    });
</script>

@endsection