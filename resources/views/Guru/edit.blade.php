@extends('layouts.layout_guru')

@section('title')
    <title>Unbreakable</title>
@endsection

@section('content')
<?php use App\Guru ;
?>
<main class="main">
    {{ Breadcrumbs::render('guru.profil.edit') }}
    <div class="container-fluid">
        <div class="animated fadeIn">


            <form action="{{route('guru.profil.update')}}" method="post" enctype="multipart/form-data" >
            @csrf
            @method('PATCH')
                <div class="row">
                    <div class="col-md-4">
                        <div class="card"  style="box-shadow: 5px 5px 10px rgba(48, 10, 64, 0.5);">
                            <div class="card-header  pt-3 pb-2 text-center" >
                                <strong style="font-size:18px"> Foto Profil </strong>
                            </div>
                            <div class="card-body">
                                <div class="form-group text-center">
                                    <label for="foto"> <b> Foto :  </b></label> <br>
                                    <img src="{{ asset('images/' . $guru->foto) }}" width="150px"  alt="{{ $guru->foto }}">
                                    <hr>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile"  name="foto">
                                        <label class="custom-file-label" for="customFile">Pilih File Foto ..</label>
                                    </div>
                                    @if($errors->has('foto'))
                                                <span class="help-block">{{$errors->first('foto')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card"  style="box-shadow: 5px 5px 10px rgba(48, 10, 64, 0.5);">
                            <div class="card-header  pt-3 pb-2  text-center"  >
                                <strong style="font-size:18px"> Foto Profil </strong>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                <div class="container">


                                    <fieldset disabled>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="disabledTextInput"> <b> User Name </b> </label>
                                                <div class="input-group mb-0">
                                                <div class="input-group-prepend" style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;">
                                                    <span class="input-group-text" id="basic-addon1"> <span class="fa fa-user"></span> </span>
                                                </div>
                                                <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ Auth::user()->name }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="disabledTextInput"> <b> Email </b> </label>
                                                <div class="input-group mb-0">
                                                <div class="input-group-prepend" style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;">
                                                    <span class="input-group-text" id="basic-addon1"> <span class="fa fa-envelope"></span> </span>
                                                </div>
                                                <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ Auth::user()->email }}" readonly >
                                            </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }} ">

                                    <div class="form-row mb-0 mt-0 pt-0">
                                        <div class="form-group col-md-6">
                                            <label for="nomor_induk"><b> NIP  : </b></label>
                                            <input type="text" class="form-control" id="nip" name="nip" value="{{$guru->nip}}" style="border-radius:10px;  box-shadow: 3px 0px 5px grey;">
                                            @if($errors->has('nip'))
                                            <span class="help-block">{{$errors->first('nip')}}</span>
                                            @endif
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="nama_lengkap"> <b>Nama Lengkap: </b> </label>
                                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{$guru->nama_lengkap}}"  style="border-radius:10px; box-shadow: 3px 0px 5px grey;">
                                            @if($errors->has('nama_lengkap'))
                                            <span class="help-block">{{$errors->first('nama_lengkap')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="jk"> <b> Jenis Kelamin : </b> </label>
                                            <input type="text" class="form-control" id="jk" name="jk"  value="{{$guru->jk}}"  style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;">
                                            @if($errors->has('jk'))
                                                <span class="help-block">{{$errors->first('jk')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="no_hp"> <b> Nomor HP : </b> </label>
                                            <input type="text" class="form-control" id="no_hp" name="no_hp"  value="{{$guru->no_hp}}"  style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;">
                                            @if($errors->has('no_hp'))
                                                <span class="help-block">{{$errors->first('no_hp')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group mt-0">
                                        <label for="instansi"> <b> Instansi : </b> </label>
                                        <input type="text" class="form-control" id="instansi" name="instansi"  value="{{$guru->instansi}}" style="border-radius:10px; box-shadow: 3px 0px 5px grey;">
                                        @if($errors->has('instansi'))
                                        <span class="help-block">{{$errors->first('instansi')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mt-0">
                                        <label for="alamat"> <b> Alamat : </b> </label>
                                        <textarea class="form-control" id="alamat" rows="2" name="alamat" style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;"> {{$guru->alamat}} </textarea>
                                        @if($errors->has('alamat'))
                                                <span class="help-block">{{$errors->first('alamat')}}</span>
                                         @endif
                                    </div>

                                    <div class="text-right"> <button type="submit" onclick="alertUpdate()" class="btn btn-info" style="box-shadow: 3px 2px 5px grey;"> Update Profil </button> </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
</main>
@endsection

@section('js')
<script>
function alertUpdate() {
    swal({
        title: "Data profil berhasil di update !",
        icon: "success",
    });
}
</script>
@endsection
