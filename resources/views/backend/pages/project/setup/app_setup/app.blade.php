@extends('backend.master.index')

@section('title', 'APP')

@section('breadcrumbs')
    <span>SETUP / APP SETUP</span> / <span class="highlight">APP</span>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            @include('backend.partial.flash-message')
            <div class="col-12">
                <div class="card-body">
                    <table id="app_table" class="table table-striped" style="width:100%"></table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('sc-modal')
@parent
<div class="sc-modal-content" id="app_form">
    <div class="sc-modal-dialog">
        <div class="sc-modal-header">
            <span class="sc-title-bar"></span>
            <span class="sc-close" onclick="scion.create.sc_modal('app_form').hide('all', modalHideFunction)"><i class="fas fa-times"></i></span>
        </div>
        <div class="sc-modal-body">
            <form id="appForm" method="post" class="form-record">
                <div class="row">
                    <div class="form-group col-12 name">
                        <label for="">NAME:</label>
                        <input type="text" class="form-control" id="name" name="name" required/>
                    </div>
                    <div class="form-group col-12 code">
                        <label for="">CODE:</label>
                        <input type="text" class="form-control lowercase" id="code" name="code" required/>
                    </div>
                    <div class="form-group col-12 app_type_id">
                        <label for="">APP TYPE:</label>
                        <select name="app_type_id" id="app_type_id" class="form-control">
                            <option value="">--SELECT APP TYPE--</option>
                        </select>
                    </div>
                    <div class="form-group col-6 icon">
                        <label for="">ICON:</label>
                        <input type="text" class="form-control lowercase" id="icon" name="icon" value="file" required/>
                    </div>
                    <div class="form-group col-6 sort_no">
                        <label for="">SORT NO.:</label>
                        <input type="number" class="form-control" id="sort_no" name="sort_no" value="0" min="0" required/>
                    </div>
                    <div class="form-group col-6">
                        <label for="">STATUS:</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">ACTIVE</option>
                            <option value="0">INACTIVE</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="">MODULE:</label>
                        <select name="module" id="module" class="form-control">
                            <option value="1">ENABLE</option>
                            <option value="0">DISABLE</option>
                        </select>
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
<script src="/js/backend/pages/project/setup/app_setup/app.js"></script>
@endsection

@section('styles')
<link href="{{asset('/css/custom/app_setup/app.css')}}" rel="stylesheet">
@endsection