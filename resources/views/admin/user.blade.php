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
                    <h2>Users Permission</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="zmdi zmdi-home"></i> Automated Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">User</a></li>
                        <li class="breadcrumb-item active">User Permission</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                  
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>  
                    <button class="btn btn-primary btn-icon float-right " type="button"><i class="zmdi zmdi-plus"></i></button>                                                            
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <table id="mainTable" class="table table-striped c_table">
                            <thead>
                                <tr>
                                    <th>Item Code</th>
                                    <th style="width:100%">Name</th>
                                    <th>Section Name</th>
                                    <th>Item Group</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Car</td>
                                    <td>100</td>
                                    <td>200</td>
                                    <td>200</td>
                                    <td>200</td>
                                    <th>
                                        <span class="checkbox">
                                            <input id="1" type="checkbox">
                                            <label for="1">
                                            </label>
                                        </span>
                                    </th>
                                </tr>
                                <tr>
                                    <td>Car</td>
                                    <td>100</td>
                                    <td>200</td>
                                    <td>200</td>
                                    <td>200</td>
                                    <th>
                                        <span class="checkbox">
                                            <input id="2" type="checkbox">
                                            <label for="2">
                                            </label>
                                        </span>
                                    </th>
                                </tr>
                                <tr>
                                    <td>Car</td>
                                    <td>100</td>
                                    <td>100</td>
                                    <td>100</td>
                                    <td>200</td>
                                    <th>
                                        <span class="checkbox">
                                            <input id="3" type="checkbox">
                                            <label for="3">
                                            </label>
                                        </span>
                                    </th>
                                </tr>
                                <tr>
                                    <td>Car</td>
                                    <td>100</td>
                                    <td>200</td>
                                    <td>200</td>
                                    <td>200</td>
                                    <th>
                                        <span class="checkbox">
                                            <input id="4" type="checkbox">
                                            <label for="4">
                                            </label>
                                        </span>
                                    </th>
                                </tr>
                                <tr>
                                    <td>Car</td>
                                    <td>100</td>
                                    <td>100</td>
                                    <td>100</td>
                                    <td>200</td>
                                    <th>
                                        <span class="checkbox">
                                            <input id="5" type="checkbox">
                                            <label for="5">
                                            </label>
                                        </span>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('page-script')
<script src="{{ asset('core-assets/controllers/adminController.js') }}"></script>
<script src="{{ asset('/') }}assets/plugins/editable-table/mindmup-editabletable.js"></script> 
<!-- Editable Table Plugin Js --> 
<script src="{{ asset('/') }}assets/js/pages/tables/editable-table.js"></script>
@stop
