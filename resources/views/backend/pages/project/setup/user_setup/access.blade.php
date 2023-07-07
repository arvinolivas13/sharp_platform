@inject('apptype', 'App\AppType')
@inject('role', 'App\Role')

@php
    // $type = 'full-view';
    $apps = $apptype->with('apps', 'apps.app_modules')->orderBy('sort_no', 'asc')->get();
    $roles = $role->get();
@endphp

@extends('backend.master.index')

@section('title', 'ACCESS')

@section('breadcrumbs')
    <span>SETUP / USER SETUP</span> / <span class="highlight">ACCESS</span>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            @include('backend.partial.flash-message')
            <div class="col-12">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="list">
                                <div class="form-group">
                                    <label for="">ROLE NAME:</label>
                                    <select name="roles" id="roles" class="form-control" onchange="selectRole()">
                                        <option value="">--SELECT A ROLE--</option>
                                        @foreach ($roles as $item_role)
                                            <option value="{{$item_role->id}}">{{$item_role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <ul id="list_access">
                                    @foreach ($apps as $app)
                                        <li class="list-header">{{$app->name}}</li>
                                            @foreach ($app->apps as $item)
                                            <li class="list-item">
                                                @if($item->module === 1)
                                                    <ul>
                                                        <li class="access-sidebar-item" id="apps-{{$item->id}}">
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <i class="align-middle mr-2 fas fa-fw fa-{{$item->icon}}"></i> <span class="app_module_name">{{$item->name}}</span>
                                                                </div>
                                                                <div class="col-5">
                                                                    <input type="checkbox" class="form-check-input check-permission check-enable" disabled/><label class="form-check-label" for="flexCheckDefault">VIEW</label>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @foreach ($item->app_modules as $module)
                                                            <li class="access-sidebar-item" id="app_module-{{$module->id}}">
                                                                <div class="row">
                                                                    <div class="col-7">
                                                                        <span class="app_module_name">{{$module->name}}</span>
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <input type="checkbox" class="form-check-input check-permission check-enable" disabled/><label class="form-check-label" for="flexCheckDefault">VIEW</label>
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <input type="checkbox" class="form-check-input check-permission check-add" disabled/><label class="form-check-label" for="flexCheckDefault">ADD</label>
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <input type="checkbox" class="form-check-input check-permission check-edit" disabled/><label class="form-check-label" for="flexCheckDefault">EDIT</label>
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <input type="checkbox" class="form-check-input check-permission check-delete" disabled/><label class="form-check-label" for="flexCheckDefault">DELETE</label>
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <input type="checkbox" class="form-check-input check-permission check-print" disabled/><label class="form-check-label" for="flexCheckDefault">PRINT</label>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <ul>
                                                        <li class="access-sidebar-item" id="apps-{{$item->id}}">
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <i class="align-middle mr-2 fas fa-fw fa-{{$item->icon}}"></i> <span class="app_module_name">{{$item->name}}</span>
                                                                </div>
                                                                <div class="col-1">
                                                                    <input type="checkbox" class="form-check-input check-permission check-enable" disabled/><label class="form-check-label" for="flexCheckDefault">VIEW</label>
                                                                </div>
                                                                <div class="col-1">
                                                                    <input type="checkbox" class="form-check-input check-permission check-add" disabled/><label class="form-check-label" for="flexCheckDefault">ADD</label>
                                                                </div>
                                                                <div class="col-1">
                                                                    <input type="checkbox" class="form-check-input check-permission check-edit" disabled/><label class="form-check-label" for="flexCheckDefault">EDIT</label>
                                                                </div>
                                                                <div class="col-1">
                                                                    <input type="checkbox" class="form-check-input check-permission check-delete" disabled/><label class="form-check-label" for="flexCheckDefault">DELETE</label>
                                                                </div>
                                                                <div class="col-1">
                                                                    <input type="checkbox" class="form-check-input check-permission check-print" disabled/><label class="form-check-label" for="flexCheckDefault">PRINT</label>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                @endif
                                            @endforeach
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('sc-modal')
@parent
<div class="sc-modal-content" id="role_form">
    <div class="sc-modal-dialog">
        <div class="sc-modal-header">
            <span class="sc-title-bar"></span>
            <span class="sc-close" onclick="scion.create.sc_modal('role_form').hide('all', modalHideFunction)"><i class="fas fa-times"></i></span>
        </div>
        <div class="sc-modal-body">
            <form id="roleForm" method="post" class="form-record">
                <div class="row">
                    <div class="form-group col-12 firstname">
                        <label for="name">NAME:</label>
                        <input type="text" class="form-control" id="name" name="name" required/>
                    </div>
                    <div class="form-group col-12 middlename">
                        <label for="description">DESCRIPTION:</label>
                        <textarea name="description" id="description" class="form-control" required></textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
    

@endsection

@section('scripts')
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="/js/backend/pages/project/setup/user_setup/access.js"></script>
@endsection

@section('styles')
<link href="{{asset('/css/custom/user_setup/access.css')}}" rel="stylesheet">
@endsection