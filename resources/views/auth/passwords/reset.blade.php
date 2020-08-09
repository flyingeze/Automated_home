@extends('layouts.app')

@section('content')
<div class="authentication">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-12">
                <form class="card auth_form"  method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <div class="header">
                        <img class="logo" src="{{ asset('assets/images/logo.svg') }}" alt="">
                        <h5>Reset Password</h5>
                    </div>

                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="body">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror " placeholder="Email"
                            name="email" value="{{ $email ?? old('email') }}"
                            autofocus>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                            </div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        
                        <div class="input-group mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                            name="password">
                            <div class="input-group-append">                                
                                <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror                        
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Confirm Password"
                            name="password-confirm">
                            <div class="input-group-append">                                
                                <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                            </div>                       
                        </div>

                        <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">Reset Password</button>
                    </div>
                </form>
                <div class="copyright text-center">
                    &copy;
                    <script>document.write(new Date().getFullYear())</script>,
                    <span>Designed by <a href="https://roboticscenterhq.com/" target="_blank">Robotics Center</a></span>
                </div>
            </div>
            <div class="col-lg-8 col-sm-12">
                <div class="card">
                    <img src="{{ asset('assets/images/home_bg.jpg') }}" alt="Reset Password"/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
