<?php
use Illuminate\Support\Facades\Request
?>
@extends('layouts.frontend.master')


@section('modal')
@include('modals.new-group-modal')
@stop

@section('content')

<div class="uk-panel {{Request::segment(2)}}">
    <div class="uk-panel-badge uk-badge">Its sales time hurry!</div>
    <h1 class="uk-panel-title uk-title">Groups</h1>
    <p class="uk-lead">Manage contact groups</p>

    <div class="uk-panel uk-panel-box">
        <a class="uk-button" href="" data-uk-modal="{target:'#new-group-modal'}">New Group</a>
    </div>


    <div class="table-container">


        <table class="uk-table uk-table-hover uk-table-condensed" id="group-table">
            <caption>All Groups</caption>
            <tbody>
                <tr>
                    <th>Group name</th>
                    <th>Group Count</th>
                    <th>&nbsp;</th>
                </tr>
                @foreach($data as $group)
                <tr>
                    <td>{{$group->group_name}}</td>
                    <td>{{$group->contacts->count()}}</td>
                    <td class="uk-clearfix contacts-dropdown" style="position: relative">
                        <div data-uk-dropdown="{mode:'click'}">
                            <a href=""><i class="uk-icon-sort-down"></i> </a>
                            <div class="uk-dropdown">
                                <ul class="uk-nav uk-nav-dropdown">
                                    <li><a href="" class="" id="view" data-id="{{$group->id}}">View Contacts</a></li>
                                    <li><a href="" class="" id="add" data-id="{{$group->id}}">Add Contact</a></li>
                                    <li><a href="" class="" id="upload" data-id="{{$group->id}}">Upload Contacts</a></li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


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