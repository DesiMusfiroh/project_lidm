<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Download Jawaban Ujian</title>
</head>
<body>        
<?php
 $tgl=date('d-m-Y');
 ?>     
    <p align="right"> Dicetak pada  <?php  echo $tgl; ?> </p>
    <center><h3>Kunci Jawaban <br/>{{$paket_soal->judul}} </h3></center>

<hr>
<center>
@if($soal_pilgan->count() != 0)
<table  width="30%">
<tr>
<td> <h3> Pilihan Ganda</h3></td>
</tr>
</table>
<table  width="30%">
	<tr>
        <td  width="10%"><b>No.</b></td>
        <td  width="10%" ><b>Kunci</b></td>
        <td  width="10%"></td>
	</tr>
    <?php $i = 0; ?>
	@foreach($soal_pilgan as $item)
	<tr>

		<td><?php   $i++;  echo $i; ?>.</td>
        <td>{!!$item->pilgan->kunci!!}</td>
        <td > (Poin : {{$item->poin}}) </td>

    </tr>
    <tr>

		<td>{{$item->kunci}}</td>
    
	</tr> 
    @endforeach
  </table>
@else
<table>
</table>
@endif
<br/>
@if($soal_essay->count() != 0)
<table width="30%">
  <tr>
<td> <h3> Essay</h3></td>
</tr>
</table>
  <table width="100%">
	<tr>
        <td width="5%"><b>No.</b></td>
		<td width="85%"><b>Kunci</b></td>
		<td width="10%">&nbsp;</td>
	</tr>
    <?php $i = 0; ?>
	@foreach($soal_essay as $item)
	<tr>
		<td><?php   $i++;  echo $i; ?>.</td>
        <td>{!!$item->essay->jawaban!!}</td>
        <td>(Poin : {{$item->poin}})</td>
    </tr>
    @endforeach
</table>
@else
<table>
</table>
@endif
</center>

</body>
</html>
