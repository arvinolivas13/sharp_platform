@extends('backend.master.index')

@section('title', 'ACTIVITY LOG')

@section('breadcrumbs')
    <span>SETUP / </span> / <span class="highlight">ACTIVITY LOG</span>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            @include('backend.partial.flash-message')
            <div class="col-12">
                <div class="card-body">
                    <table id="activity_log_table" class="table table-striped" style="width:100%">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('sc-modal')
@parent

@endsection
@endsection

@section('scripts')
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="/js/backend/pages/project/setup/activity_log.js"></script>
@endsection

@section('styles')
<link href="{{asset('/css/custom/app_setup/activity_log.css')}}" rel="stylesheet">
@endsection