<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title> Hasil Ujian Peserta</title>
</head>
<body>
<?php
 $tgl=date('d-m-Y');
 ?>
    <p align="right"> Dicetak pada  <?php  echo $tgl; ?> </p>
    <center><h3>Rekapitulasi Nilai <br/>{{$ujian->nama_ujian}} </h3></center>

<center>
<hr>
<table >
<tr >
<td> Nama Paket Soal </td>
<td>: {{$ujian->paket_soal->judul}}</td>
</tr>
<tr>
<td>Jumlah soal</td>
<td>: {{$ujian->paket_soal->jumlah_soal()}} soal</td>
</tr>
<tr>
<td>Tanggal Ujian </td>
<td>: {{date('d M Y',strtotime($ujian->waktu_mulai))}} </td>
<tr>
</table>
<br/>
<br/>

@if ($ujian->peserta_ujian->count() != 0)
<table rules="all" width="100%">
	<tr>
        <td align="center" width="10%"><b>No.</b></td>
        <td width="70%"><b >  &nbsp; Nama Peserta</b></td>
        <th width="20%">Nilai</th>
    </tr>
    
    @foreach($peserta_ujian as $item)
	<tr>

		<td align="center">{{$loop->iteration}}</td>
		<td >  </td>
		<td align="center"></td>
      
    </tr>
  @endforeach
  @else

  (Belum ada peserta yang mengikuti ujian ini !)

  @endif
  </table>

</center>

</body>
</html>
