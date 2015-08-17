<?php
use Illuminate\Support\Facades\Request
?>
@extends('layouts.frontend.master')


@section('modal')
@include('modals.new-group-modal')
@include('modals.show-group-contacts-modal')
@include('modals.new-contact-modal')
@stop

@section('content')

<div class="uk-panel {{Request::segment(2)}}">
    <div class="uk-panel-badge uk-badge">Its sales time hurry!</div>
    <h1 class="uk-panel-title uk-title">Groups</h1>
    <p class="uk-lead">Manage contact groups</p>

    <div class="uk-panel uk-panel-box">
        <a class="uk-button" href="" data-uk-modal="{target:'#new-group-modal'}">New Group</a>
    </div>


    <div id="table-container">

        @include('ajax.groups')


    </div>


</div>
@stop

@section('foot')
@parent
<script src="/assets/uikit/js/components/notify.min.js"></script>
<script src="/assets/uikit/js/components/datepicker.min.js"></script>
<script src="/assets/uikit/js/components/timepicker.min.js"></script>
<script src="/assets/uikit/js/components/autocomplete.min.js"></script>

<script src="/assets/js/groups.js"></script>
@stop