@extends('layouts.layout_siswa')
@section('title')
	<title>Ujian Saya</title>
@endsection
@section('content')
<div>
  {{ Breadcrumbs::render('siswa.ujian.index') }}
</div>
<div class="">
		@if($peserta_ujian->count() != 0)
		<div class="row">
			@foreach($peserta_ujian as $item)
			<div class="col-md-4">
				<a href="{{route('waitUjian',$item->id)}}">
			    <div class="card mb-3 widget-content">
			        <div class="widget-content-wrapper text-white">
			            <div class="widget-content-left">
			                <div class="widget-heading text-white"><span> {{$item->ujian->nama_ujian}}</span></div>
											<div class="widget-heading text-white" title="Waktu mulai ujian">{{date('d M Y, H:i',strtotime($item->ujian->waktu_mulai))}}</div>
											<div class="widget-subheading text-white">
												<span>
													<?php
													if ($item->ujian->status == 0) {
															echo "ujian segera dimulai";
													} elseif ($item->ujian->status == 1) {
															echo "ujian sedang berlangsung";
													} elseif ($item->ujian->status == 2) {
															echo "ujian telah berakhir";
													}
													?>
												</span>
											</div>
			            </div>
			            <div class="widget-content-right">

			            </div>
			        </div>
			    </div>
				</a>
			</div>
		@endforeach
		</div>
		@else
		<div class="col-md-12">
				<div class="alert alert-warning" role="alert">
						Tidak ada ujian yang akan diikuti
				</div>
		</div>
		@endif
	</div>

	<script>
	  $(document).ready(function() {
	    var r = Math.round(Math.random() * 255 + 1);
	    var g = Math.round(Math.random() * 255 + 1);
	    var b = Math.round(Math.random() * 255 + 1);
			console.log(r,g,b);
	    // var card = document.querySelector('.card');
			$('.card').css({
				'backgroundImage' :'linear-gradient(to right, rgb('+r+','+g+','+b+'), rgb('+r+','+g+','+b+'),rgb('+r+','+g+','+b+')'
			});
	  });
		// linear-gradient(to right, #4682B4, #00FFFF, #00FA9A);
		// 'linear-gradient(to right, rgb('+r+','+g+','+b+'), rgb('+r+','+g+','+b+'),rgb('+r+','+g+','+b+')'
	</script>
@endsection
