@extends('layouts.app')

@section('content')
<div class="authentication">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-12">
                <form class="card auth_form"  method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="header">
                        <img class="logo" src="{{ asset('assets/images/logo.svg') }}" alt="">
                        <h5>Forgot Password?</h5>
                        <span>Enter your e-mail address below to reset your password.</span>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="body">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror " placeholder="Email"
                            name="email" value="{{ old('email') }}"
                            autofocus>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-email"></i></span>
                            </div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">SUBMIT</button>                       
                        <div class="signin_with mt-3">
                            <a href="javascript:void(0);" class="link">Need Help?</a>
                        </div>
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
                    <img src="{{ asset('assets/images/home_bg.jpg') }}" alt="Request password"/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
