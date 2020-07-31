@extends('layouts.layout_siswa')
@section('title')
	<title>Ujian Saya</title>
@endsection
@section('content')
<div>
  {{ Breadcrumbs::render('guru.kelas') }}
</div>
<div class="main">
	<div class="">
		<div class="row">
			@if($peserta->count() != 0)
			@foreach($peserta as $item)
			<div class="col-md-4">	
			    <div class="card mb-3 widget-content bg-arielle-smile">
			        <div class="widget-content-wrapper text-white">
			            <div class="widget-content-left">
			                <div class="widget-heading">{{$item->ujian->nama_ujian}}</div>
			            </div>
			            <div class="widget-content-right">
			                <div class="widget-numbers text-white"><span>Nilai {{$item->nilai}}</span></div>
			            </div>
			        </div>
			    </div>
			</div>
			@endforeach
			@endif
		</div>
	</div>
</div>

<button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#exampleModalLong">
    Long Content
</button>

@endsection 
@section('modal')
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-group" action="{{route('coba')}}" method="post">
            @csrf
            <div class="modal-body">
                    <input type="text" name="nama"> Nama 
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection