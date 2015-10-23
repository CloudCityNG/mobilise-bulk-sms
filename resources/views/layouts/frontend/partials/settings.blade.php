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
            <li class="{{markActive($urlPath, 'settings/profile')}}"><a href="{{url('settings/profile')}}">Profile</a></li>
            <li class="{{markActive($urlPath, 'settings/security')}}"><a href="{{url('settings/security')}}">Security</a></li>
            <li class="{{markActive($urlPath, 'settings/notifications')}}"><a href="{{url('settings/notifications')}}">Notifications</a></li>
        <li class="uk-nav-divider"></li>
        <li class="uk-nav-header">Account</li>
            <li class="{{markActive($urlPath, 'settings/billing')}}"><a href="{{url('settings/billing')}}">Billing</a></li>
    </ul>
</div>