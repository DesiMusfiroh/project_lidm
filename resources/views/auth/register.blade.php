@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center mt-1">
        
        <div class="col-md-7">
            <div class="card text-center" style="border-radius:30px;">
            
                <div class="card-body">

                    <div class="row text-center mt-3 mb-3">
                        <div class="col-md-12">
                            <h2><strong>Register</strong></h2>
                        </div>
                    </div>

                    <ul class="nav nav-tabs mr-4 ml-4 text-center justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item" role="guru">
                        <a class="nav-link active" id="guru-tab" data-toggle="tab" href="#guru" role="tab" aria-controls="guru" aria-selected="true">Register Sebagai Guru</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="siswa-tab" data-toggle="tab" href="#siswa" role="tab" aria-controls="siswa" aria-selected="false">Register Sebagai Siswa</a>
                    </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active mt-4 container" id="guru" role="tabpanel" aria-labelledby="guru-tab">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <input type="hidden" name="role" value="1">

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-2 " style="box-shadow: 3px 3px 5px grey; border-radius:30px;">
                                            <div class="input-group-prepend" >
                                                <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0px 0px 30px; ">Username</span>
                                            </div>
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="" style="border-radius:1px 30px 30px 0px; height:45px;">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <div class="col-md-12">
                                        <div class="input-group mb-2 " style="box-shadow: 3px 3px 5px grey; border-radius:30px;">
                                            <div class="input-group-prepend" >
                                                <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0px 0px 30px;  ">Alamat Email</span>
                                            </div>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" style="border-radius:1px 30px 30px 0px; height:45px;">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group mb-2 " style="box-shadow: 3px 3px 5px grey; border-radius:30px;">
                                            <div class="input-group-prepend" >
                                                <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0px 0px 30px;"></span>
                                            </div>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" style="border-radius:1px 30px 30px 0px; height:45px;">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-2 " style="box-shadow: 3px 3px 5px grey; border-radius:30px;">
                                            <div class="input-group-prepend" >
                                                <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0px 0px 30px;"></span>
                                            </div>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" style="border-radius:1px 30px 30px 0px; height:45px;">
            
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group row mb-2 mt-3">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-info" style="border-radius:30px; height:45px; width:150px; box-shadow: 5px 5px 10px grey;">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane mt-4 container " id="siswa" role="tabpanel" aria-labelledby="siswa-tab">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <input type="hidden" name="role" value="0">

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-2 " style="box-shadow: 3px 3px 5px grey; border-radius:30px;">
                                            <div class="input-group-prepend" >
                                                <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0px 0px 30px; ">Username</span>
                                            </div>
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="" style="border-radius:1px 30px 30px 0px; height:45px;">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <div class="col-md-12">
                                        <div class="input-group mb-2 " style="box-shadow: 3px 3px 5px grey; border-radius:30px;">
                                            <div class="input-group-prepend" >
                                                <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0px 0px 30px;  ">Alamat Email</span>
                                            </div>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" style="border-radius:1px 30px 30px 0px; height:45px;">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group mb-2 " style="box-shadow: 3px 3px 5px grey; border-radius:30px;">
                                            <div class="input-group-prepend" >
                                                <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0px 0px 30px;"></span>
                                            </div>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" style="border-radius:1px 30px 30px 0px; height:45px;">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-2 " style="box-shadow: 3px 3px 5px grey; border-radius:30px;">
                                            <div class="input-group-prepend" >
                                                <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0px 0px 30px;"></span>
                                            </div>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" style="border-radius:1px 30px 30px 0px; height:45px;">
            
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group row mb-2 mt-3">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-info" style="border-radius:30px; height:45px; width:150px; box-shadow: 5px 5px 10px grey;">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

               

                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(function () {
        $('#myTab li:last-child a').tab('show')
    })
</script>
@endsection
