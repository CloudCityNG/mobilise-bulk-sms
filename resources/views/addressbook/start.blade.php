@extends('layouts.frontend.master')

@section('head')
@parent
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="/assets/uikit/css/components/datepicker.min.css">
@stop

@section('content')

<div class="uk-panel all-contacts">
    <div class="uk-panel-badge uk-badge">Its sales time hurry!</div>
    <h3 class="uk-panel-title">Address Book</h3>

    <div class="contacts-controls">
        <div class="uk-grid">
            <div class="uk-width-medium-1-1">
                <div class="uk-panel uk-panel-box">
                    <a class="uk-button" href="" data-uk-modal="{target:'#new-contact-modal'}">New Contact</a>
                    <a class="uk-button" href="" data-uk-modal="{target:'#new-group-modal'}">New Group</a>
                </div>
            </div>
        </div>
    </div>

    <div id="table-container">
        <div id="alphabet-controls" class="uk-margin-left uk-margin-top uk-panel-box">
            <a href="">A</a>
            <a href="">B</a>
            <a href="">C</a>
        </div>
        @include('ajax.contacts')
    </div>

</div>
@stop

@section('modal')

@include('modals.edit-contact-modal')
@include('modals.send-sms-modal')
@include('modals.new-contact-modal')
@include('modals.new-group-modal')
@stop


@section('foot')
@parent
<script src="/assets/uikit/js/components/notify.min.js"></script>
<script src="/assets/uikit/js/components/datepicker.min.js"></script>
<script src="/assets/uikit/js/components/timepicker.min.js"></script>
<script src="/assets/uikit/js/components/autocomplete.min.js"></script>
<script src="/assets/js/stopVerbosity.min.js"></script>

<script src="/assets/js/start.js"></script>
@stop