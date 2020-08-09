@extends('layouts.app')

@section('page-style')
@stop
@section('controller', "dashbordController")

@section('content')
<!-- Page Content  -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Accessible Items</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="zmdi zmdi-home"></i>Dashboard</a></li>
                    <li class="breadcrumb-item active">Accessible Items</li>
                </ul>
                <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">                
                <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix"  ng-if="currentUser.role == 'admin' || currentUser.role == 'super admin'">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <a href="#">
                    <div class="card widget_2 big_icon email">
                        <div class="body">
                            <h6>Items</h6>
                            <h2>@{{ currentUser.totalItemCount }} <small class="info">of 100</small></h2>
                            <small>Total Registered email</small>
                            <div class="progress">
                                <div class="progress-bar l-purple" role="progressbar" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100" style="width: 39%;"></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <a href="#">
                    <div class="card widget_2 big_icon traffic">
                        <div class="body">
                            <h6>Sections</h6>
                            <h2>@{{ currentUser.totalSectionCount }} <small class="info">of 1Tb</small></h2>
                            <small>2% higher than last month</small>
                            <div class="progress">
                                <div class="progress-bar l-amber" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%;"></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <a href="#">
                    <div class="card widget_2 big_icon sales">
                        <div class="body">
                            <h6>Section Group</h6>
                            <h2>@{{ currentUser.totalSectionGroupCount }} <small class="info">with 
                                ( @{{ currentUser.totalItemGroupCount }} Item Group)</small></h2>
                            <small>6% higher than last month</small>
                            <div class="progress">
                                <div class="progress-bar l-blue" role="progressbar" aria-valuenow="38" aria-valuemin="0" aria-valuemax="100" style="width: 38%;"></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <a href="#">
                    <div class="card widget_2 big_icon domains">
                        <div class="body">
                            <h6>Users</h6>
                            <h2>@{{ currentUser.totalUserCount }} <small class="info">of 10</small></h2>
                            <small>Total Registered Domain</small>
                            <div class="progress">
                                <div class="progress-bar l-green" role="progressbar" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100" style="width: 89%;"></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card mcard_4">
                    <div class="body">
                        {{-- <ul class="header-dropdown list-unstyled">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-menu"></i> </a>
                                <ul class="dropdown-menu slideUp">
                                    <li><a href="javascript:void(0);">Edit</a></li>
                                    <li><a href="javascript:void(0);">Delete</a></li>
                                    <li><a href="javascript:void(0);">Report</a></li>
                                </ul>
                            </li>
                        </ul> --}}
                        <div class="img">
                            <img src="{{ asset('/') }}assets/images/home2.png" class="rounded-circle" alt="profile-image">
                        </div>
                        <div class="user">
                            <h5 class="mt-3 mb-1">@{{ currentUser.building.name }}</h5>
                            <small class="text-muted">Address: @{{ currentUser.building.address }}</small>
                        </div>
                    </div>
                </div>
            </div>                
            <div class="col-lg-9 col-md-6 col-sm-6">
                <div class="row">

                    <div class="col-lg-3 col-md-6 col-sm-6" ng-repeat="group in currentUser.building.sectionGroups">
                        <a href="{{ route('home')}}/@{{ group.id}}/sections">
                            <div class="card w_data_1">
                                <div class="body">
                                    <div class="w_icon @{{ group.icon_color}}"><i class="@{{ group.icon}}"></i></div>
                                    <h4 class="mt-3 mb-0">@{{ group.name}}</h4>
                                    <span class="text-muted">@{{ group.totalItemCount}} Items</span>
                                    <div class="w_description text-success">
                                        <i class="zmdi zmdi-trending-up"></i>
                                        <span>@{{ group.totalActiveItemCount}} Active Items</span>
                                    </div>
                                </div>
                            </div>
                        </a>
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
