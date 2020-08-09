@extends('layouts.app')

@section('page-style')
@stop
@section('controller', "adminController")

@section('content')
<!-- Page Content  -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Item Group</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="zmdi zmdi-home"></i> Automated Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Items</a></li>
                        <li class="breadcrumb-item active">Item Group</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                  
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>                      
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <h1>Coming Soon</h1>
        </div>
    </div>
</section>
@stop

@section('page-script')
<script src="{{ asset('core-assets/controllers/adminController.js') }}"></script>
<script src="{{ asset('/') }}assets/plugins/editable-table/mindmup-editabletable.js"></script> <!-- Editable Table Plugin Js --> 

<script src="{{ asset('/') }}assets/js/pages/tables/editable-table.js"></script>
@stop
