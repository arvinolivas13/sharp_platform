
@extends('backend.master.index')


@section('title', 'APP MODULE')

@section('breadcrumbs')
    <span>SETUP / APP SETUP</span> / <span class="highlight">APP MODULE</span>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            @include('backend.partial.flash-message')
            <div class="col-12">
                <div class="card-body">
                    <table id="app_module_table" class="table table-striped" style="width:100%">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('sc-modal')
@parent
<div class="sc-modal-content" id="app_module_form">
    <div class="sc-modal-dialog">
        <div class="sc-modal-header">
            <span class="sc-title-bar"></span>
            <span class="sc-close" onclick="scion.create.sc_modal('app_module_form').hide('all', modalHideFunction)"><i class="fas fa-times"></i></span>
        </div>
        <div class="sc-modal-body">
            <form id="app_moduleForm" method="post" class="form-record">
                <div class="row">
                    <div class="form-group col-12 name">
                        <label for="">NAME:</label>
                        <input type="text" class="form-control" id="name" name="name" required/>
                    </div>
                    <div class="form-group col-12 code">
                        <label for="">CODE:</label>
                        <input type="text" class="form-control lowercase" id="code" name="code" required/>
                    </div>
                    <div class="form-group col-12 app_id">
                        <label for="">APP:</label>
                        <select name="app_id" id="app_id" class="form-control">
                            <option value="">--SELECT APP--</option>
                        </select>
                    </div>
                    <div class="form-group col-12 sort_no">
                        <label for="">SORT NO.:</label>
                        <input type="number" class="form-control" id="sort_no" name="sort_no" value="0" min="0" required/>
                    </div>
                    <div class="form-group col-12 status">
                        <label for="">STATUS:</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">ACTIVE</option>
                            <option value="0">INACTIVE</option>
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
<script src="/js/backend/pages/project/setup/app_setup/app_module.js"></script>
@endsection