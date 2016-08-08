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
                        <button class="btn btn-primary btn-sm" id="change-password">Change Password</button>
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

    <div class="modal fade" id="password-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Change Password</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form id="change-password-form" class="col-lg-8" autocomplete="off">
                            <div class="form-group">
                                <label for="current-password">Current Password</label>
                                <input type="password" name="current-password" id="current-password" class="form-control" placeholder="Current Password">
                            </div>
                            <div class="form-group">
                                <label for="new-password">New Password</label>
                                <input type="password" name="new-password" id="new-password" class="form-control" placeholder="New Password">
                            </div>
                            <div class="form-group">
                                <label for="new-password_confirmation">Confirm New Password</label>
                                <input type="password" name="new-password_confirmation" id="new-password_confirmation" class="form-control" placeholder="Confirm New Password">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="save">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('foot')
    <script>
        $(function () {
            $('button#change-password').click(function (e) {
                e.preventDefault();
                $('#password-modal').modal('show');
            });

            $('#save').click(function (e) {
                e.preventDefault();
                var jqXHR = $.post();
            });

        })
    </script>

@endsection