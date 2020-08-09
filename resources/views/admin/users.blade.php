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
                    <h2>Users Tables</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="zmdi zmdi-home"></i> Automated Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Users</a></li>
                        <li class="breadcrumb-item active">Users Tables</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                  
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>  
                    <button class="btn btn-primary btn-icon float-right " type="button" data-toggle="modal" data-target="#addUser"><i class="zmdi zmdi-plus"></i></button>                                                            
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div ng-if="success" class="alert alert-success">
                            User added/Updated successfully
                        </div>
                        <div ng-if="error" class="alert alert-danger">
                            @{{ error.message }}
                        </div>
                        <table id="mainTable" class="table table-striped c_table">
                            <thead>
                                <tr>
                                    <th style="width:50%">Name</th>
                                    <th style="width:25%">Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th style="width:25%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="user in users">
                                    <td>@{{ user.name }}</td>
                                    <td>@{{ user.email }}</td>
                                    <td class="text-capitalize">@{{ user.role }}</td>
                                    <td>
                                        <span ng-if="user.status == 1">Active</span>
                                        <span ng-if="user.status == 0">Inactive</span>
                                    </td>
                                    <th>
                                        <button class="btn btn-primary btn-icon float-right " ng-click="addUserPermission(user)" type="button"><i class="zmdi zmdi-accounts-add"></i></button>
                                        <button class="btn btn-primary btn-icon float-right " ng-click="showUser(user)" type="button"><i class="zmdi zmdi-edit"></i></button>
                                        <button class="btn btn-primary btn-icon float-right " ng-click="deleteUser(user)" type="button"><i class="zmdi zmdi-delete"></i></button>
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
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="addUserModalLabel">Add New User</h4>
            </div>
            <div class="modal-body">
                <div class="body">
                    <div ng-if="error" class="alert alert-danger">
                        @{{ error.message }}
                        <p ng-if='error.errors.name'> <span ng-repeat="error in error.errors.name">@{{ error }}</span></p>
                        <p ng-if='error.errors.email'> <span ng-repeat="error in error.errors.email">@{{ error }}</span></p>
                        <p ng-if='error.errors.phone'> <span ng-repeat="error in error.errors.phone">@{{ error }}</span></p>
                        <p ng-if='error.errors.password'> <span ng-repeat="error in error.errors.password">@{{ error }}</span></p>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Full name"
                        ng-model="newUser.name">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" 
                            class="form-control" 
                            placeholder="Email"
                            ng-model="newUser.email">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="zmdi zmdi-email"></i></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" 
                            class="form-control" 
                            placeholder="Phone number"
                            ng-model="newUser.phone">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="zmdi zmdi-phone"></i></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select type="text" 
                            class="form-control" 
                            placeholder="Select Role"
                            ng-model="newUser.role">
                            <option value="member">Member</option>
                            <option value="admin">Admin</option>
                            <option value="super admin">Super Admin</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" 
                            class="form-control"
                            placeholder="Password"
                            ng-model="newUser.password">
                        <div class="input-group-append">                                
                            <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                        </div>                       
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-round waves-effect" ng-click="addUser()">SAVE USER</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="showUser" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="addUserModalLabel">Update User</h4>
            </div>
            <div class="modal-body">
                <div class="body">
                    <div ng-if="error" class="alert alert-danger">
                        @{{ error.message }}
                        <p ng-if='error.errors.name'> <span ng-repeat="error in error.errors.name">@{{ error }}</span></p>
                        <p ng-if='error.errors.email'> <span ng-repeat="error in error.errors.email">@{{ error }}</span></p>
                        <p ng-if='error.errors.phone'> <span ng-repeat="error in error.errors.phone">@{{ error }}</span></p>
                        <p ng-if='error.errors.password'> <span ng-repeat="error in error.errors.password">@{{ error }}</span></p>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Full name"
                        ng-model="selectedUser.name">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" 
                            class="form-control" 
                            placeholder="Email"
                            ng-model="selectedUser.email">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="zmdi zmdi-email"></i></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" 
                            class="form-control" 
                            placeholder="Phone number"
                            ng-model="selectedUser.phone">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="zmdi zmdi-phone"></i></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select type="text" 
                            class="form-control" 
                            placeholder="Select Role"
                            ng-model="selectedUser.role">
                            <option value="member">Member</option>
                            <option value="admin">Admin</option>
                            <option value="super admin">Super Admin</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-round waves-effect" ng-click="updateUser()">Update USER</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addUserPermission" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="addUserModalLabel">Update User</h4>
            </div>
            <div class="modal-body">
                <div class="body">
                    <div ng-if="error1" class="alert alert-danger">
                        @{{ error1.message }}
                    </div>
                    <div ng-if="success1" class="alert alert-success">
                        Access right added/removed successfully
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Grant Access To</strong> @{{ selectedUser.name }} </h2>
                            </div>
                            <div class="body">
                                <p>Check the box to grant/remove access right to a user.</p>
                                <div class="panel-group full-body" id="accordion_5" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-primary" ng-repeat="sectionGroup in selectedUser.sectionGroups">
                                        <div class="panel-heading" role="tab" id="headingOne_5">
                                            <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion_5" href="#collapseOne_5" aria-expanded="false" aria-controls="collapseOne_5" class="collapsed"> @{{ sectionGroup.name }} </a> </h4>
                                        </div>
                                        <div id="collapseOne_5" class="panel-collapse in collapse" role="tabpanel" aria-labelledby="headingOne_5" style="">
                                            <div class="panel-body">
                                                <div class="panel panel-primary" ng-repeat="section in sectionGroup.sections">
                                                    <div class="panel-heading" role="tab" id="headingOne_5">
                                                        <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion_5" href="#collapseOne_5" aria-expanded="false" aria-controls="collapseOne_5" class="collapsed"> @{{ section.name}} </a> </h4>
                                                    </div>
                                                    <div id="collapseOne_5" class="panel-collapse in collapse" role="tabpanel" aria-labelledby="headingOne_5" style="">
                                                        <div class="panel-body">
                                                            <div class="panel panel-primary" ng-repeat="itemGroup in section.itemGroups">
                                                                <div class="panel-heading" role="tab" id="headingOne_5">
                                                                    <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion_5" href="#collapseOne_5" aria-expanded="false" aria-controls="collapseOne_5" class="collapsed"> @{{ itemGroup.name}} </a> </h4>
                                                                </div>
                                                                <div id="collapseOne_5" class="panel-collapse in collapse" role="tabpanel" aria-labelledby="headingOne_5" style="">
                                                                    <div class="panel-body">
                                                                        <div class="checkbox" ng-repeat="item in itemGroup.items">
                                                                            <input id="@{{ item.name }}" ng-click="grantAccess(selectedUser.id, item.id)" ng-checked="item.access == 1" type="checkbox">
                                                                            <label for="@{{ item.name }}">
                                                                                @{{ item.name }}
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-round waves-effect" ng-click="updateUser()">Update USER</button>
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
