<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Download Hasil Ujian</title>

</head>
<body>          
    <p align="right"> Waktu Ujian :{{$peserta_ujian->ujian->waktu_mulai}} </p>
    <center><h3>Review Hasil<br> {{$peserta_ujian->ujian->nama_ujian}} </h3></center> 
        <center> <hr>
            <table>
                <tr>
                    <td> Nama </td>
                    <td> : {{ $nama_lengkap }}</td>
                </tr>
                <tr>
                @if ($instansi  !== null)
                    <td>Instansi</td>
                    <td>: {{$instansi}}</td>
                @else
                    <td>Instansi </td>
                    <td>: -</td>
                @endif
                </tr>
                <tr>
                @if ($no_hp  !== null)
                    <td>No. Hp </td>
                    <td>: {{$no_hp}}</td>
                @else
                    <td>No. Hp </td>
                    <td>: - </td>
                @endif
                </tr>
                <tr>
                    <td>Nilai  </td>
                    <td>: {{$nilai_akhir}} </td>
                </tr>
            </table> <hr>
            @if($pilgan_jawab->count() != 0)
            <table width="100%">
                <tr>
                    <td width="5%" ><b>No.</b></td>
		            <td width="95%"><b>Soal Pilihan Ganda</b></td>
	            </tr>
                <tr>
                    <td colspan="2"></td>
	            </tr>
                <tr>
                    <td colspan="2"></td>
	            </tr>
    
            <?php $i = 0; ?>
	        @foreach($pilgan_jawab as $item)
	            <tr>
                    <td><?php   $i++;  echo $i; ?></td>
                    <td>{!!$item->pilgan->pertanyaan!!}</td>
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
	            </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>Jawaban Anda : {!!$item->jawab!!} @if ($item->status == 'T') (Benar) <b> (Poin : {!!$item->score!!}) </b> @elseif($item->status == 'F') (Salah) <b>(Poin : {!!$item->score!!})  Kunci {!!$item->pilgan->kunci!!} </b> @endif</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
	            </tr>
                <tr>
                    <td></td>
                    <td></td>
	            </tr>
            @endforeach 
            </table>
                 @else
                    <table></table>
            @endif
            <br/>
                <br/>
                   
            @if($essay_jawab->count() != 0)
            <table width="100%">
	            <tr>
                    <td width="5%"><b>No.</b></td>
		            <td width="95%"><b>Soal Essay</b></td>
	            </tr>
                <tr>
                    <td colspan="2"></td>
	            </tr>
            <?php $i = 0; ?>
	        @foreach($essay_jawab as $item)
	        <tr>
                <td><?php   $i++;  echo $i; ?></td>
                <td>{!!$item->essay->pertanyaan!!}</td>
            </tr>
            <tr>
                <td></td>
                <td>Jawaban Anda : {!!$item->jawab!!} <b>(poin :  {!!$item->score!!}) <b></td>
	        </tr>
            <tr>
                <td></td>
                <td><b>Kunci :</b> {!!$item->essay->jawaban!!} </td>
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

