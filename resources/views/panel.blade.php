@extends('layout.master')

@section('outside-panel')
    <div class="alert alert-success" id="notification" style="display: none">

    </div>
@endsection

@section('panel')
    <div class="panel-header">
        Welcome to Admin Panel
    </div>
    <div class="panel-body">
        Click "Site" to see the menu on the left.
    </div>
@endsection
