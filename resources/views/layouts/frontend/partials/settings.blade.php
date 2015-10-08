<?php
$urlPath = \Illuminate\Support\Facades\Request::path();

function markActive($urlPath, $thisLink)
{
    if ( $urlPath == $thisLink )
    {
        return 'uk-active';
    }
}
?>

<div class="uk-panel uk-panel-box uk-hidden-small uk-margin-large-top" data-uk-sticky>
    {{--<h3 class="uk-panel-title">Control Panel</h3>--}}
    <ul class="uk-nav uk-nav-side uk-nav-parent-icon" data-uk-nav="{multiple:true}">
        <li class="uk-nav-header">User</li>
            <li class="{{markActive($urlPath, 'user/profile')}}"><a href="{{url('user/profile')}}">Profile</a></li>
            <li class="{{markActive($urlPath, 'user/security')}}"><a href="{{url('user/security')}}">Security</a></li>
            <li class="{{markActive($urlPath, 'user/notifications')}}"><a href="{{url('user/notifications')}}">Notifications</a></li>
        <li class="uk-nav-divider"></li>
        <li class="uk-nav-header">Account</li>
            <li class="{{markActive($urlPath, 'user/dashboard')}}"><a href="{{url('user/dashboard')}}">Dashboard</a></li>



    </ul>
</div>