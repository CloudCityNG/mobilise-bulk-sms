<?php $urlPath = url(\Illuminate\Support\Facades\Request::path()); ?>

<div class="ui fluid vertical menu" style="margin-bottom: 20px;">

    <a class="item {{mark_active($urlPath, $sideMenu->account_setting, 1)}}" href="{{$sideMenu->account_setting}}">
        <i class="settings icon"></i> Account
    </a>

    <a class="item {{mark_active($urlPath, $sideMenu->other_setting, 1)}}" href="{{$sideMenu->other_setting}}">
        <i class="setting icon"></i> Other Details
    </a>

    <a class="item {{mark_active($urlPath, $sideMenu->notifications, 1)}}" href="{{$sideMenu->notifications}}">
        <i class="mail square icon"></i> Email Notification
    </a>

    <a class="item {{mark_active($urlPath, $sideMenu->orders, 1)}}" href="{{$sideMenu->orders}}">
        <i class="shop icon"></i> Orders
    </a>

    <a class="item {{mark_active($urlPath, $sideMenu->payments, 1)}}" href="{{$sideMenu->payments}}">
            <i class="payment icon"></i> Payments
    </a>
</div>