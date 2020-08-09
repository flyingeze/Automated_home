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
                    <h2>Section Group Tables</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="zmdi zmdi-home"></i> Automated Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Section Group</a></li>
                        <li class="breadcrumb-item active">Section Group Tables</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                  
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <button class="btn btn-primary btn-icon float-right " type="button" data-toggle="modal" data-target="#addSectionGroup"><i class="zmdi zmdi-plus"></i></button>                                                     
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
                                    <th style="width:100%">Name</th>
                                    <th>Section Count</th>
                                    <th>Item Count</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="group in sectionGroups">
                                    <td>@{{ group.name }}</td>
                                    <td>@{{ group.totalSectionCount}}</td>
                                    <td>@{{ group.totalItemCount}}</td>
                                    <td>
                                        <span ng-if="group.status == 1">Active</span>
                                        <span ng-if="group.status == 0">Inactive</span>
                                    </td>
                                    <th>
                                        <button class="btn btn-primary btn-icon float-right " ng-click="showSectionGroup(group)" type="button"><i class="zmdi zmdi-edit"></i></button>
                                        <button class="btn btn-primary btn-icon float-right " ng-click="deleteSectionGroup(group)" type="button"><i class="zmdi zmdi-delete"></i></button>
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



<div class="modal fade" id="addSectionGroup" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="addSectionModalLabel">Add New Section Group</h4>
            </div>
            <div class="modal-body">
                <div class="body">
                    <div ng-if="error" class="alert alert-danger">
                        @{{ error.message }}
                        <p ng-if='error.errors.name'> <span ng-repeat="error in error.errors.name">@{{ error }}</span></p>
                        <p ng-if='error.errors.sectionGroup'> <span ng-repeat="error in error.errors.email">@{{ error }}</span></p>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Section name"
                        ng-model="newSectionGroup.name">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Section Icon"
                        ng-model="newSectionGroup.icon">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-round waves-effect" ng-click="addSectionGroup()">SAVE SECTION</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="showSectionGroup" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="addSectionModalLabel">Update Section Group</h4>
            </div>
            <div class="modal-body">
                <div class="body">
                    <div ng-if="error" class="alert alert-danger">
                        @{{ error.message }}
                        <p ng-if='error.errors.name'> <span ng-repeat="error in error.errors.name">@{{ error }}</span></p>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Section name"
                        ng-model="selectedSectionGroup.name">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Section Icon"
                        ng-model="selectedSectionGroup.icon">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-round waves-effect" ng-click="updateSectionGroup()">Update SECTION</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>

@stop

@section('page-script')
<script src="{{ asset('core-assets/controllers/adminController.js') }}"></script>
<script src="{{ asset('/') }}assets/plugins/editable-table/mindmup-editabletable.js"></script> <!-- Editable Table Plugin Js --> 

<script src="{{ asset('/') }}assets/js/pages/tables/editable-table.js"></script>
@stop
