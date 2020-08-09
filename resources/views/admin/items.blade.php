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
                    <button class="btn btn-primary btn-icon float-right " type="button" data-toggle="modal" data-target="#addItem"><i class="zmdi zmdi-plus"></i></button>                      
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
                                    <th style="width:75%">Name</th>
                                    <th>Section Group</th>
                                    <th>Section</th>
                                    <th>Item Group</th>
                                    <th>Status</th>
                                    <th style="width:25%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in items">
                                    <td>@{{ item.item_code }}</td>
                                    <td>@{{ item.name }}</td>
                                    <td>@{{ item.section_group.name }}</td>
                                    <td>@{{ item.section.name }}</td>
                                    <td>@{{ item.item_group.name }}</td>
                                    <td>
                                        <span ng-if="item.status == 1">Active</span>
                                        <span ng-if="item.status == 0">Inactive</span>
                                    </td>
                                    <th>
                                        <button class="btn btn-primary btn-icon float-right " ng-click="showItem(item)" type="button"><i class="zmdi zmdi-edit"></i></button>
                                        <button class="btn btn-primary btn-icon float-right " ng-click="deleteItem(item)" type="button"><i class="zmdi zmdi-delete"></i></button>
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

<div class="modal fade" id="addItem" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="addSectionModalLabel">Add New Item</h4>
            </div>
            <div class="modal-body">
                <div class="body">
                    <div ng-if="error" class="alert alert-danger">
                        @{{ error.message }}
                        <p ng-if='error.errors.name'> <span ng-repeat="error in error.errors.name">@{{ error }}</span></p>
                        <p ng-if='error.errors.sectionGroup'> <span ng-repeat="error in error.errors.email">@{{ error }}</span></p>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Item code"
                        ng-model="newItem.code">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Item name"
                        ng-model="newItem.name">
                    </div>
                    {{-- <div class="input-group mb-3">
                        <select class="form-control show-tick"
                            ng-change = "changeSection()"
                            ng-model="newItem.sectionGroup">
                            <option value="@{{ sectionGroup.id }}" ng-repeat="sectionGroup in sectionGroups">@{{ sectionGroup.name }}</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-control show-tick"
                            ng-model="newItem.section">
                            <option value="@{{ section.id }}" ng-repeat="section in sections">@{{ section.name }}</option>
                        </select>
                    </div> --}}
                    <div class="input-group mb-3">
                        <select class="form-control show-tick"
                            ng-model="newItem.itemGroup">
                            <option value="@{{ itemGroup.id }}" ng-repeat="itemGroup in itemGroups">@{{ itemGroup.name }}</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Item Icon"
                        ng-model="newItem.icon">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-round waves-effect" ng-click="addItem()">SAVE SECTION</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="showItem" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="addSectionModalLabel">Update Item</h4>
            </div>
            <div class="modal-body">
                <div class="body">
                    <div ng-if="error" class="alert alert-danger">
                        @{{ error.message }}
                        <p ng-if='error.errors.name'> <span ng-repeat="error in error.errors.name">@{{ error }}</span></p>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Item name"
                        ng-model="selectedItem.item_code">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Item name"
                        ng-model="selectedItem.name">
                    </div>
                    {{-- <div class="input-group mb-3">
                        <select class="form-control show-tick"
                            ng-model="selectedItem.section_group_id">
                            <option value="@{{ sectionGroup.id }}" ng-repeat="sectionGroup in sectionGroups">@{{ sectionGroup.name }}</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-control show-tick"
                            ng-model="selectedItem.section_id">
                            <option value="@{{ section.id }}" ng-repeat="section in sections">@{{ section.name }}</option>
                        </select>
                    </div> --}}
                    <div class="input-group mb-3">
                        <select class="form-control show-tick"
                            ng-model="selectedItem.item_group_id">
                            <option value="@{{ itemGroup.id }}" ng-repeat="itemGroup in itemGroups">@{{ itemGroup.name }}</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Section Icon"
                        ng-model="selectedItem.icon">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-round waves-effect" ng-click="updateItem()">Update Item</button>
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
