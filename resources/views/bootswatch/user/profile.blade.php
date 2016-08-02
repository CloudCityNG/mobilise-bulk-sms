@extends('layouts.bootswatch.master')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h1>Profile</h1>

            <div class="well clearfix">
                <div class="col-lg-12">
                    <div class="avatar pull-left" style="padding:20px;">
                        <img src="/img/avatar1.png" width="200" alt="">
                    </div>
                    <div class="user" style="margin-top: 20px; vertical-align: baseline">
                        <h3>{{$currentUser->username}}</h3>
                        <h4>{{$currentUser->email}}</h4>
                        <button class="btn btn-primary btn-sm">Edit Profile</button>
                    </div>
                </div>
                <div>
                    <h4 style="border-bottom:1px solid silver;margin-bottom:30px">Other Details</h4>
                </div>
                @if($currentUser->userdetails()->count())
                    <dl class="dl-horizontal">
                        <dt>Firstname</dt>
                        <dd>{{$currentUser->username}}</dd>

                        <dt>Lastname</dt>

                        <dt>Phone</dt>
                        <dd>{{$currentUser->username}}</dd>

                        <dt>Date of Birth</dt>
                        <dd>{{$currentUser->username}}</dd>
                    </dl>
                @else
                    <div class="update">
                    <button class="btn btn-primary btn-sm">Update Other details</button>
                    </div>
                @endif


            </div>
        </div>
    </div>

@endsection