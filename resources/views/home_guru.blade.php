@extends('layouts.layout_guru')
<?php  use App\Guru;
    $guru = Guru::where('user_id', Auth::user()->id )->first();
?>


@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')


<main class="main">
    <div>
      {{ Breadcrumbs::render('home') }}
    </div>
    <index-component></index-component>
    
<div class="container-fluid"> 
    @if( $guru != null )  
    <div class="card bg-heavy-rain " >
        <div class="card-body" >
            <div class="media">
                <img style="width: 150px; height: 150px; display: block;  margin: auto;" src="/images/{{$guru->foto}}" alt="">
                <div class="media-body ml-4">
                <h5 class="mt-0 text-uppercase font-weight-bold">Selamat Datang : {{auth()->user()->name}} </h5>
               
                <table width="80%" style="font-size:16px; ">         
                    <tr>
                        <td width="30%">NIP</td>
                        <td>:</td>
                        <td>{{auth()->user()->guru->nip}}</td>
                    </tr>
                    <tr>
                        <td width="30%">Nama</td>
                        <td>:</td>
                        <td class="text-uppercase font-weight-bold">{{auth()->user()->guru->nama_lengkap}}</td>
                    </tr>
                    <tr>
                        <td width="30%">Instansi</td>
                        <td>:</td>
                        <td>{{auth()->user()->guru->instansi}}</td>
                    </tr>
                    <tr>
                        <td width="30%">Alamat</td>
                        <td>:</td>
                        <td>{{auth()->user()->guru->alamat}}</td>
                    </tr>
                    <tr>
                        <td width="30%">Email</td>
                        <td>:</td>
                        <td>{{auth()->user()->email}}</td>
                    </tr>
                </table>
                </div>
            </div>          
        </div>         
    </div>

    <div class="divider mt-0" style="margin-bottom: 10px;">&nbsp;</div>
        <div class="row">
            <div class="col-lg-6 col-xl-4">
                <div class="card mb-3 widget-content bg-heavy-rain">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="widget-heading">Jumlah Kelas</div>
                            <div class="widget-subheading">Jumlah kelas yang di ajar</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers "><span>{{auth()->user()->guru->jumlah_kelas()}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-4">
                <div class="card mb-3 widget-content bg-heavy-rain ">
                    <div class="widget-content-wrapper ">
                        <div class="widget-content-left">
                            <div class="widget-heading">Jumlah Siswa</div>
                            <div class="widget-subheading">Total siswa yang di ajar</div>
                        </div>
                        <!-- jumlah siswa masih salah -->
                        <div class="widget-content-right">
                            <div class="widget-numbers "><span>{{$siswaku}}</span></div>
                        </div>
                        <!-- jumlah siswa masih salah -->
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-4">
                <div class="card mb-3 widget-content bg-heavy-rain ">
                    <div class="widget-content-wrapper ">
                        <div class="widget-content-left">
                            <div class="widget-heading">Jumlah Ujian</div>
                            <div class="widget-subheading">Total ujian yang di buat</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers "><span>{{auth()->user()->guru->jumlah_ujian()}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading"><b>Selamat Datang, {{auth()->user()->name}} !</b></h4>
        <p>Selamat datang di aplikasi LinesRoom (Live Learning Assessment Room).  <br>
        LinesRoom merupakan aplikasi pembelajaran daring berbasis web dengan sejumlah inovasi fitur, yang dapat menjadikan penilaian kompetensi siswa diperoleh dari berbagai aspek secara lebih komprehensif, sehingga akan membantu mewujudkan implementasi pendidikan holistik di indonesia, terutama pada masa pandemi ini.</p>
        <hr>
        
        <p class="mb-0">Anda telah mendaftar sebagai <b>GURU</b> </p>
    </div>

    <div class="row">
            <div class="col-md-12 ">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Silahkan Lengkapi Profil Anda!</strong> Klik pada bagian profil
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            </div>
        </div>
        <div class="divider mt-0" style="margin-bottom: 10px;">&nbsp;</div>
            <div class="row">
                <div class="col-lg-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-heavy-rain">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="widget-heading">Jumlah Kelas</div>
                                <div class="widget-subheading">Jumlah kelas yang di ajar</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers "><span>0</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-heavy-rain ">
                        <div class="widget-content-wrapper ">
                            <div class="widget-content-left">
                                <div class="widget-heading">Jumlah Siswa</div>
                                <div class="widget-subheading">Total siswa yang di ajar</div>
                            </div>
                            <!-- jumlah siswa masih salah -->
                            <div class="widget-content-right">
                                <div class="widget-numbers "><span>0</span></div>
                            </div>
                            <!-- jumlah siswa masih salah -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-heavy-rain ">
                        <div class="widget-content-wrapper ">
                            <div class="widget-content-left">
                                <div class="widget-heading">Jumlah Ujian</div>
                                <div class="widget-subheading">Total ujian yang di buat</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers "><span>0</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
  
</div>

</main>

@endsection