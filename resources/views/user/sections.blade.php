@extends('layouts.app')

@section('page-style')
@stop
@section('controller', "sectionsController")

@section('content')
<!-- Page Content  -->
<input type="text" name="sectionGroup" hidden id="sectionGroup" value="{{ $sectionGroup->id ?? '' }}">
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Dashboard</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="zmdi zmdi-home"></i>My Home</a></li>
                    <li class="breadcrumb-item active">@{{ sectionGroup.name }}</li>
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
                <div class="card mcard_4 @{{ sectionGroup.icon_color }}">
                    <div class="body">
                        <div class="img">
                            <img src="{{ asset('/') }}assets/images/home2.png" class="rounded-circle" alt="profile-image">
                        </div>
                        <div class="user">
                            <h5 class="mt-3 mb-1">@{{ sectionGroup.name }}</h5>
                            <small class="text-muted">Building: @{{ currentUser.building.name }}</small>
                        </div>
                    </div>
                </div>
            </div>                
            <div class="col-lg-9 col-md-6 col-sm-6">
                <div class="row">

                    <div class="col-lg-3 col-md-6 col-sm-6" ng-repeat="section in sectionGroup.sections">
                        <a href="{{ route('home')}}/@{{ section.section_group_id+'/'+section.id}}/item-groups">
                            <div class="card w_data_1">
                                <div class="body">
                                    <div class="w_icon @{{ section.icon_color}}"><i class="@{{ section.icon}}"></i></div>
                                    <h4 class="mt-3 mb-0">@{{ section.name}}</h4>
                                    <span class="text-muted">@{{ section.totalItemCount }} Items</span>
                                    <div class="w_description text-success">
                                        <i class="zmdi zmdi-trending-up"></i>
                                        <span>@{{ section.totalActiveItemCount }} Active Items</span>
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
