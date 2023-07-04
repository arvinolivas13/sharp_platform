
@extends('backend.master.index')

@section('title', 'ROLE')

@section('breadcrumbs')
    <span>SETUP / USER SETUP</span> / <span class="highlight">ROLE</span>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            @include('backend.partial.flash-message')
            <div class="col-12">
                <div class="card-body">
                    <table id="role_table" class="table table-striped" style="width:100%">
                    </table>
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
<script src="/js/backend/pages/project/setup/user_setup/roles.js"></script>
@endsection