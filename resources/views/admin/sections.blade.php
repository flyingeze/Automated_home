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
                    <h2>Sections Tables</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="zmdi zmdi-home"></i> Automated Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Sections</a></li>
                        <li class="breadcrumb-item active">Sections Tables</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                  
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <button class="btn btn-primary btn-icon float-right " type="button" data-toggle="modal" data-target="#addSection"><i class="zmdi zmdi-plus"></i></button>                                                           
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
                                    <th style="width:50%">Name</th>
                                    <th style="width:50%">Section Group</th>
                                    <th style="width:50%">Item Group Count</th>
                                    <th>Item Count</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="section in sections">
                                    <td>@{{ section.name }}</td>
                                    <td>@{{ section.sectionGroup.name }}</td>
                                    <td>@{{ section.totalItemGroupCount}}</td>
                                    <td>@{{ section.totalItemCount}}</td>
                                    <td>
                                        <span ng-if="section.status == 1">Active</span>
                                        <span ng-if="section.status == 0">Inactive</span>
                                    </td>
                                    <th>
                                        <button class="btn btn-primary btn-icon float-right " ng-click="showSection(section)" type="button"><i class="zmdi zmdi-edit"></i></button>
                                        <button class="btn btn-primary btn-icon float-right " ng-click="deleteSection(section)" type="button"><i class="zmdi zmdi-delete"></i></button>
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

<div class="modal fade" id="addSection" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="addSectionModalLabel">Add New Section</h4>
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
                        ng-model="newSection.name">
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-control show-tick"
                            ng-model="newSection.sectionGroup"
                            ng-change="changeSectionGroup()">
                            <option value="@{{ sectionGroup.id }}" ng-repeat="sectionGroup in sectionGroups">@{{ sectionGroup.name }}</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Section Icon"
                        ng-model="newSection.icon">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-round waves-effect" ng-click="addSection()">SAVE SECTION</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="showSection" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="addSectionModalLabel">Update Section</h4>
            </div>
            <div class="modal-body">
                <div class="body">
                    <div ng-if="error" class="alert alert-danger">
                        @{{ error.message }}
                        <p ng-if='error.errors.name'> <span ng-repeat="error in error.errors.name">@{{ error }}</span></p>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Section name"
                        ng-model="selectedSection.name">
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-control show-tick"
                            ng-model="selectedSection.section_group_id">
                            <option ng-repeat="sectionGroup in sectionGroups" value="@{{ sectionGroup.id }}">@{{ sectionGroup.name }}</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Section Icon"
                        ng-model="selectedSection.icon">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-round waves-effect" ng-click="updateSection()">Update SECTION</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>

@stop

@section('page-script')
<script src="{{ asset('core-assets/controllers/adminController.js') }}"></script>
<script src="{{ asset('/') }}assets/plugins/editable-table/mindmup-editabletable.js"></script> 
<!-- Editable Table Plugin Js --> 
<script src="{{ asset('/') }}assets/js/pages/tables/editable-table.js"></script>
@stop
