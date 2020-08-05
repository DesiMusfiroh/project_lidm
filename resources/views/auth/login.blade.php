@extends('layouts.app')
<style>
body {
    background: url('/images/back2.jpg') no-repeat center  fixed;
}
.form-control {
    border-radius: 20px;
}

</style>
@section('content')


<div class="container">
    <div class="row justify-content-center mt-5">
        
        <div class="col-md-6">
            <div class="card text-center" style="border-radius:30px;">
            
                <div class="card-body" style=" background: linear-gradient(180deg, #12C3CE 0%, #D7E8E9 100%); box-shadow: 0px 0px 30px 10px rgba(0, 0, 0, 0.4);   border-radius: 22px;" >
                    <div class="row text-center mt-3 mb-3">
                        <div class="col-md-12">
                            <h2><strong>Login</strong></h2>
                        </div>
                    </div>
                    <div class="container">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row ">
                            <div class="col-md-12">
                                <div class="input-group mb-2 " style="box-shadow: 3px 3px 5px grey; border-radius:30px;">
                                    <div class="input-group-prepend" >
                                        <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0px 0px 30px "><i class="fa fa-envelope ml-2 mr-1" width="20px" style="font-size:18px"></i></span>
                                    </div>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email" style="border-radius:1px 30px 30px 0px; height:45px;">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="input-group mb-2 " style="box-shadow: 3px 3px 5px grey; border-radius:30px;">
                                    <div class="input-group-prepend" >
                                        <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0px 0px 30px "><i class="fa fa-lock ml-2 mr-2" width="20px" style="font-size:18px"></i></span>
                                    </div>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password"  style="border-radius:1px 30px 30px 0px; height:45px; ">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success" style="border-radius:30px; height:45px; width:150px; box-shadow: 5px 5px 10px grey;">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>

                        <div class="row ">  
                            <div class="col-md-12">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link " href="{{ route('password.request') }}" >
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection
