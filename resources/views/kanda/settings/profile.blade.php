@extends('layouts.kanda.frontend')


@section('content')
<div class="boxx">
    <h3 class="ui header blue box-header">
        <i class="computer icon blue"></i>
        <div class="content">
            Account
        </div>
    </h3>

    @include('layouts.kanda.partials.errors')

    {!! Form::open(['url'=>'settings/account', 'class'=>'ui form', 'id'=>'account-settings', 'autocomplete'=>'off']) !!}
    <form class="ui form" action="" style="" autocomplete="off">
        <div class="field">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="{{Auth::user()->email}}" readonly=""/>
        </div>

        <div class="field">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="{{Auth::user()->username}}" />
        </div>

        <div class="field">
            <label for="old_password">Old Password</label>
            <input type="password" name="old_password" id="old_password" value=""/>
        </div>

        <div class="field">
            <label for="password">New Password</label>
            <input type="password" name="password" id="password" value="" />
        </div>

        <div class="field">
            <label for="password_confirmation">New Password Confirmation</label>
            <input type="password" name="password_confirmation" id="password_confirmation" />
        </div>

        <div class="field">
            <input type="submit" name="submit" value="Update Profile" class="ui button primary"/>
        </div>

    </form>
</div>
@endsection