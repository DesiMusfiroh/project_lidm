@extends('layouts.layout_guru')

@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')
<?php  use App\Guru;
    $guru = Guru::where('user_id', Auth::user()->id )->first();
?>
<main class="main">
    <div>
      {{ Breadcrumbs::render('guru.profil') }}
    </div>

<div class="container">
@if ( Guru::where('user_id', Auth::user()->id )->first() != null )
    <div class="row">

        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header pt-3 pb-2 text-center">
                    <strong style="font-size:18px; "> Profil</strong>
                </div>
                <div class="card-body pb-0 ">
                        <!-- @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif -->

                    <div class="container">

                            <div class="form-row ">
                                <div class="form-group col-md-6">
                                    <label for="disabledTextInput"><b> User Name </b> </label>
                                    <div class="input-group mb-0">
                                    <div class="input-group-prepend" style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;">
                                        <span class="input-group-text" id="basic-addon1"> <span class="fa fa-user"></span> </span>
                                    </div>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="{{auth()->user()->name}}" readonly="">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="disabledTextInput"><b> Email </b></label>
                                    <div class="input-group mb-0">
                                    <div class="input-group-prepend" style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;">
                                        <span class="input-group-text" id="basic-addon1"> <span class="fa fa-envelope"></span> </span>
                                    </div>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="{{auth()->user()->email}}" readonly="">
                                    </div>
                                </div>
                            </div>

                            <table class="table table-hover table-sm">
                                <tr>
                                    <td col><b> No. Induk </b> </td>
                                    <td> : </td>
                                    <td>{{ $guru->nip }}</td>
                                </tr>
                                <tr>
                                    <td col><b> Nama Lengkap</b> </td>
                                    <td> : </td>
                                    <td>{{ $guru->nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <td col><b> Jenis Kelamin </b> </td>
                                    <td> : </td>
                                    <td>{{ $guru->jk }}</td>
                                </tr>
                                <tr>
                                    <td col><b> Nomor HP </b> </td>
                                    <td> : </td>
                                    <td>{{ $guru->no_hp }}</td>
                                </tr>
                                <tr>
                                    <td col><b> Instansi </b> </td>
                                    <td> : </td>
                                    <td>{{ $guru->instansi }}</td>
                                </tr>

                                <tr>
                                    <td col><b> Alamat </b> </td>
                                    <td> : </td>
                                    <td>{{ $guru->alamat }}</td>
                                </tr>

                            </table>
                    </div>
                </div>

                <div class="card-footer justify-content-center" style="border-radius: 0px 0px 20px 20px ">
                    <a href="{{route('guru.profil.edit')}}"><button class="btn btn-info"  style="box-shadow: 3px 2px 5px grey;"> Edit Profil </button></a>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="card" >
                <div class="card-header pt-3 pb-2 justify-content-center" >
                    <strong style="font-size:18px"> Foto Profil </strong>
                </div>
                <div class="card-body text-center">
                    <div class="form-group">
                        <img src="/images/{{$guru->foto}}" class="img-fluid mx-auto ">
                    </div>
                </div>
            </div>
        </div>
    </div>
@else

    <form action="{{route('guru.profil.store')}}" method="post" enctype="multipart/form-data" >
    @csrf
        <div class="row">


            <div class="col-md-8">
                <div class="card"  style="box-shadow: 5px 5px 10px rgba(48, 10, 64, 0.5);">
                    <div class="card-header  pt-3 pb-2 text-center"  >
                        <strong style="font-size:18px"> Profil </strong>
                    </div>
                    <div class="card-body pb-0">
                        <div class="container">

                                <div class="form-row ">
                                    <div class="form-group col-md-6">
                                        <label for="disabledTextInput"><b> User Name </b> </label>
                                        <div class="input-group mb-0">
                                        <div class="input-group-prepend" style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;">
                                            <span class="input-group-text" id="basic-addon1"> <span class="fa fa-user"></span> </span>
                                        </div>
                                        <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ Auth::user()->name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="disabledTextInput"><b> Email </b></label>
                                        <div class="input-group mb-0">
                                        <div class="input-group-prepend" style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;">
                                            <span class="input-group-text" id="basic-addon1"> <span class="fa fa-envelope"></span> </span>
                                        </div>
                                        <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ Auth::user()->email }}" readonly >
                                        </div>
                                    </div>
                                </div>

                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }} ">
                            <div class="form-row mb-0 mt-0 pt-0">
                                <div class="form-group col-md-6">
                                    <label for="nomor_induk"><b> No. Induk  : </b></label>
                                    <input type="text" class="form-control" id="nip" name="nip" style="border-radius:10px;  box-shadow: 3px 0px 5px grey;">
                                    @if($errors->has('nip'))
                                    <span class="help-block">{{$errors->first('nip')}}</span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="nama_lengkap"> <b>Nama Lengkap: </b> </label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" style="border-radius:10px; box-shadow: 3px 0px 5px grey;">
                                    @if($errors->has('nama_lengkap'))
                                    <span class="help-block">{{$errors->first('nama_lengkap')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row mb-0 mt-0 pt-0">
                                <div class="form-group col-md-6">
                                    <label for="no_hp"><b> Nomor HP  : </b></label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="+62 ..." style="border-radius:10px;  box-shadow: 3px 0px 5px grey;">
                                    @if($errors->has('no_hp'))
                                    <span class="help-block">{{$errors->first('no_hp')}}</span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="jk"> <b> Jenis Kelamin : </b> </label>
                                    <input type="text" class="form-control" id="jk" name="jk" style="border-radius:10px; box-shadow: 3px 0px 5px grey;">
                                    @if($errors->has('jk'))
                                    <span class="help-block">{{$errors->first('jk')}}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="instansi"> <b> Instansi : </b> </label>
                                    <input type="text" class="form-control" id="instansi" name="instansi" style="border-radius:10px; box-shadow: 3px 0px 5px grey;">
                                    @if($errors->has('instansi'))
                                    <span class="help-block">{{$errors->first('instansi')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group mt-0 text-center ">
                                <label for="alamat" class="text-left"><b> Alamat : </b> </label>
                                <textarea class="form-control" id="alamat" rows="2" name="alamat" style="border-radius:10px;  box-shadow: 2px 1px 3px grey;"> </textarea>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card"  style="box-shadow: 5px 5px 10px rgba(48, 10, 64, 0.5);">
                    <div class="card-header  pt-3 pb-2 text-center" >
                        <strong style="font-size:18px"> Foto Profil </strong>
                    </div>
                    <div class="card-body  pb-0">
                        <div class="form-group">
                            <label for="file_foto"> <b> Foto : </b> </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile"  name="foto">
                                <label class="custom-file-label" for="customFile"></label>
                            </div>

                            @if($errors->has('foto'))
                              <span class="help-block">{{$errors->first('foto')}}</span>
                            @endif
                        </div>
                        

                        <div class="text-right" > <button type="submit" onclick="alert()" class="btn btn-info mb-3" style="box-shadow: 3px 2px 5px grey;">Simpan Profil </button> </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endif
</div>
</main>
@if(session('error'))
  <script>
  $(document).ready(function() {
        swal({
          title: "Oops",
          text: "Lengkapi profil terlebih dahulu",
          icon: "warning",
          button: "Oke",
        });
  });
  </script>
@endif
@endsection

@section('js')
<script>
function alert() {
    swal({
        title: "Data profil berhasil di simpan !",
        icon: "success",
    });
}
</script>
@endsection