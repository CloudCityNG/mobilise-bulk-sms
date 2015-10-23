@extends('layouts.frontend.master')


@section('content')
<?php
use Illuminate\Support\Facades\Auth;
?>
{{--modal here--}}
@include('modals.edit-profile-modal')

@include('layouts.frontend.partials.errors')

<div class="uk-container uk-grid uk-margin">

    <div class="uk-grid uk-width-medium-7-10" id="profile-container">
        <div class="uk-width-medium-2-10">
            {!! get_gravatar($currentUser->email) !!}
        </div>

        <div class="uk-width-medium-8-10">
            <h3 style="font-weight: 600">{{$currentUser->username}}</h3>
            <ul class="uk-list">
                <li>Member Since {{$currentUser->created_at->format('d/m/Y')}}</li>
                <li>Registered Via {{ empty($currentUser->social_auth_type) ? 'Web' : $currentUser->social_auth_type}}</li>
            </ul>
            @if (Auth::user()->userdetails()->exists())
            <dl class="uk-description-list-line">
                {{-- Check if user single detail exists --}}
                @if($currentUser->userdetails->firstname !== NULL)
                <dt>Firstname</dt>
                <dd>{!! ucfirst($currentUser->userdetails->firstname) !!}</dd>
                @endif

                @if($currentUser->userdetails->lastname !== NULL)
                <dt>Lastname</dt>
                <dd>{!! ucfirst($currentUser->userdetails->lastname) !!}</dd>
                @endif

                @if($currentUser->userdetails->phone !== NULL)
                <dt>Phone Number</dt>
                <dd>{!! ucfirst($currentUser->userdetails->phone) !!}</dd>
                @endif

                @if($currentUser->userdetails->address !== NULL)
                <dt>Address</dt>
                <dd>{!! ucwords($currentUser->userdetails->address) !!}</dd>
                @endif

                @if($currentUser->userdetails->dob !== NULL)
                <dt>Date of Birth</dt>
                <dd>{!! $currentUser->userdetails->dob->format('jS \o\f F, Y') !!}</dd>
                @endif
            </dl>
                <span class="uk-text-primary uk-button uk-hidden" id="add-profile-details">Add your profile details</span>
            @else
            <span class="uk-text-primary uk-button" id="add-profile-details">Add your profile details</span>
            @endif
        </div>
    </div>

    <div class="uk-width-medium-3-10">
        <a id="edit-profile-modal-button" href="#edit-profile-modal" class="uk-button uk-button-large uk-float-right" data-uk-modal>Edit Profile</a>

    </div>
</div>


<div class="uk-width-medium-1-1 Box">
    <div class="uk-grid">
        <div class="uk-width-medium-7-10">
            <h2>Deactivate Account</h2>
            <p>This will permanently delete all contacts and messages.</p>
        </div>
        <div class="uk-width-medium-3-10">
            <a class="uk-button uk-button-large uk-button-danger" href="#">Deactivate Account</a>
        </div>
    </div>
</div>

@stop

@section('head')
@parent
<link rel="stylesheet" href="/assets/kendoui/styles/kendo.common.min.css" />
<link rel="stylesheet" href="/assets/kendoui/styles/kendo.default.min.css" />
<link rel="stylesheet" href="/assets/parsley/parsley.css" />
@stop


@section('foot')
@parent
<script src="/assets/kendoui/js/kendo.all.min.js"></script>
<script src="/assets/parsley/parsley.min.js"></script>
<script src="/assets/js/new/app.js"></script>
<script>

$(function() {

$("#dob").kendoDatePicker({
    start: 'year',
    format: "yyyy-MM-dd"
});

window.ParsleyConfig = {
    errorsWrapper: '<div></div>',
    errorTemplate: '<div class="uk-alert" role="alert"></div>'
};

var modal = new Modal('edit-profile-modal');
var form = new Form('modal-edit-profile', 'class');


var saveButton = document.getElementById('editProfileSave');
var spanAddProfileDetails = document.getElementById('add-profile-details');

spanAddProfileDetails.onclick = function(){
        modal.show();
}

});

</script>
@stop