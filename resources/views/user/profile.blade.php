@extends('layouts.app')

@section('page-style')
@stop
@section('controller', "profileController")

@section('content')
<!-- Page Content  -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Profile Edit</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item">Profile</li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div> 
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-6">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Account</strong> Settings</h2>
                        </div>
                        <div class="body">
                            
                            <div ng-if="error" class="alert alert-danger">
                                @{{ error }}
                            </div>
                            <div ng-if="success" class="alert alert-success">
                                @{{ success }}
                            </div>

                            <div class="form-group">
                                <input type="text" ng-model="currentUser.name" class="form-control" placeholder="Full Name">
                            </div>
                            <div class="form-group">
                                <input type="email" ng-model="currentUser.email" class="form-control" placeholder="E-mail">
                            </div>
                            <div class="form-group">
                                <input type="text" ng-model="currentUser.phone" class="form-control" placeholder="Phone number">
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary" ng-click="updateProfile()">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Security</strong> Settings</h2>
                        </div>
                        <div class="body">
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form  method="POST" action="{{ route('changePassword') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="password" name="current-password"
                                        class="form-control @if($errors->has('current-password')) is-invalid @endif" 
                                        placeholder="Current Password">
                                    @if ($errors->has('current-password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('current-password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="password" 
                                        name="new-password" 
                                        class="form-control  @if($errors->has('new-password')) is-invalid @endif" 
                                        placeholder="New Password">
                                    @if ($errors->has('new-password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('new-password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="password" name="new-password_confirmation" class="form-control" placeholder="Current Password">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-info">Save Changes</button>
                                </div>
                            </form>                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('page-script')
<script src="{{ asset('core-assets/controllers/dashbordController.js') }}"></script>
@stop
