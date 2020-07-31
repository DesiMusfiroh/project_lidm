<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Download Soal Ujian</title>
</head>
<body>
    <p align="right"> Dibuat pada {{date('d M Y',strtotime($paket_soal->created_at))}} </p>
    <center><h3>Naskah Soal <br/>{{$paket_soal->judul}} </h3></center>

<center>
<hr>
<table>
<tr >
<td> Nama </td>
<td> : </td>
</tr>
<tr>
<td>Institusi </td>
<td>: </td>
<tr>
<td>Tanggal Ujian </td>
<td>: </td>
<tr>
</table>
<hr>
<center>
@if($soal_pilgan->count() != 0)
<table  width="100%">
    <tr>
        <td colspan="3"><h4> Berilah tanda silang (X) pada huruf A,B,C,D Atau E di depan jawaban yang paling
            tepat pada soal yang tersedia!</h4>
        </td>
</tr>
	<tr>
        <td  width="5%"><b>No.</b></td>
        <td width="85%" ><b>Soal Pilihan Ganda</b></td>
        <td  width="10%">&nbsp;</td>
	</tr>
    <?php $i = 0; ?>
	@foreach($soal_pilgan as $item)
	<tr>

		<td><?php   $i++;  echo $i; ?></td>
        <td>{!!$item->pilgan->pertanyaan!!}</td>
        <td> (Poin : {!!$item->poin!!})</td>

    </tr>
    <tr>

		<td>&nbsp;</td>
        <td>
            A. {!!$item->pilgan->pil_a!!}<br/>
            B. {!!$item->pilgan->pil_b!!} <br/>
            C. {!!$item->pilgan->pil_c!!}<br/>
            D. {!!$item->pilgan->pil_d!!} <br/>
            E. {!!$item->pilgan->pil_e!!}<br/>
        </td>
        <td>&nbsp;</td>
	</tr>
    @endforeach
  </table>
@else
<table>
</table>
@endif

@if($soal_essay->count() != 0)

  <table width="100%">
  <tr>
        <td colspan="3"><h4> Jawablah pertanyaan berikut dengan benar!</h4>
        </td>
</tr>
	<tr>
        <td width="5%"><b>No.</b></td>
		<td width="85%"><b>Soal Essay</b></td>
		<td width="10%"></td>
	</tr>
    <?php $i = 0; ?>
	@foreach($soal_essay as $item)
	<tr>
		<td><?php   $i++;  echo $i; ?></td>
        <td>{!!$item->essay->pertanyaan!!}</td>
        <td>(Poin : {!!$item->poin!!})</td>
    </tr>
    @endforeach
    <tr>
        <td colspan="3"><b>Jawaban :</b></td>
    </tr>

</table>
@else
<table>
</table>
@endif
</center>

</body>
</html>
