@extends('layouts.layout_siswa')
@section('title','Ujian Saya')
@section('content')
<div>
  {{ Breadcrumbs::render('guru.kelas') }}
</div>
<div class="main">
	<div class="">
		<div class="row">
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
		</div>
	</div>
</div>
@endsection 