
@extends('backend.master.index')


@section('title', 'USER')

@section('breadcrumbs')
    <span>SETUP / USER SETUP</span> / <span class="highlight">USER</span>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            @include('backend.partial.flash-message')
            <div class="col-12">
                <div class="card-body">
                    <table id="user_table" class="table table-striped" style="width:100%">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('sc-modal')
@parent
<div class="sc-modal-content" id="user_form">
    <div class="sc-modal-dialog">
        <div class="sc-modal-header">
            <span class="sc-title-bar"></span>
            <span class="sc-close" onclick="scion.create.sc_modal('user_form').hide('all', modalHideFunction)"><i class="fas fa-times"></i></span>
        </div>
        <div class="sc-modal-body">
            <form id="userForm" method="post" class="form-record">
                <div class="row">
                    <div class="form-group col-12 firstname">
                        <label for="firstname">FIRST NAME:</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" required/>
                    </div>
                    <div class="form-group col-12 middlename">
                        <label for="middlename">MIDDLE NAME:</label>
                        <input type="text" class="form-control" id="middlename" name="middlename" required/>
                    </div>
                    <div class="form-group col-12 lastname">
                        <label for="lastname">LAST NAME:</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" required/>
                    </div>
                    <div class="form-group col-12 suffix">
                        <label for="suffix">SUFFIX:</label>
                        <input type="text" class="form-control" id="suffix" name="suffix" required/>
                    </div>
                    <div class="form-group col-12 email">
                        <label for="email">EMAIL:</label>
                        <input type="email" class="form-control" id="email" name="email" required/>
                    </div>
                    <div class="form-group col-12 status">
                        <label for="status">STATUS:</label>
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

<div class="sc-modal-content" id="access_form">
    <div class="sc-modal-dialog">
        <div class="sc-modal-header">
            <span class="sc-title-bar"></span>
            <span class="sc-close" onclick="scion.create.sc_modal('access_form').hide('all', modalHideFunction)"><i class="fas fa-times"></i></span>
        </div>
        <div class="sc-modal-body">
            <form id="userForm" method="post" class="form-record">
                <div class="row">
                    <div class="form-group col-12 role_id">
                        <label for="role_id">ROLE NAME:</label>
                        <select name="role_id" id="role_id" class="form-control">
                            <option value=""></option>
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
<script src="/js/backend/pages/project/setup/user_setup/user.js"></script>
@endsection