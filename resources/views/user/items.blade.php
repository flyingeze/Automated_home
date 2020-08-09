@extends('layouts.app')

@section('page-style')
@stop
@section('controller', "itemsController")

@section('content')
<!-- Page Content  -->
<input type="text" name="sectionGroup" hidden id="sectionGroup" value="{{ $sectionGroup ?? '' }}">
<input type="text" name="section" hidden id="section" value="{{ $section ?? '' }}">
<input type="text" name="itemGroup" hidden id="itemGroup" value="{{ $itemGroup ?? '' }}">

<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Dashboard</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="zmdi zmdi-home"></i>My Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('sections', $sectionGroup) }}">@{{ section.sectionGroup.name }}</a></li>
                    <li class="breadcrumb-item active">@{{ section.name }}</li>
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
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card mcard_4 @{{ section.icon_color }}">
                    <div class="body">
                        <div class="img">
                            <img src="{{ asset('/') }}assets/images/home2.png" class="rounded-circle" alt="profile-image">
                        </div>
                        <div class="user">
                            <h5 class="mt-3 mb-1">@{{ section.itemGroup.name }}</h5>
                            <small class="text-muted">Building: @{{ currentUser.building.name }}</small>
                        </div>
                    </div>
                </div>
            </div>                
            <div class="col-lg-9 col-md-6 col-sm-6">
                <div class="row">

                    <div class="col-lg-3 col-md-6 col-sm-6" ng-repeat="item in section.itemGroup.items">
                        <div class="card w_data_1" ng-click="toggle(item)">
                            <div class="body">
                                <div class="w_icon @{{ item.icon_color}}"><i class="@{{ item.icon }}"></i></div>
                                <h4 class="mt-3 mb-0">@{{ item.name}}</h4>
                                {{-- <span class="text-muted">@{{ item.totalItemCount }} Items</span> --}}
                                <div class="w_description text-warning" ng-if="item.status == 1">
                                    <span>Active</span>
                                </div>
                                <div class="w_description text-success" ng-if="item.status == 0">
                                    <span>Inactive</span>
                                </div>
                            </div>
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
