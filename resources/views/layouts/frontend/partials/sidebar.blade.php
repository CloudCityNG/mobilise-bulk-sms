<?php
$urlPath = \Illuminate\Support\Facades\Request::path();
?>

<div class="uk-panel uk-panel-box uk-hidden-small" data-uk-sticky>
    {{--<h3 class="uk-panel-title">Control Panel</h3>--}}
    <ul class="uk-nav uk-nav-side uk-nav-parent-icon" data-uk-nav="{multiple:true}">
        <li class="{{mark_active($urlPath, 'user/dashboard')}}"><a href="{{url('user/dashboard')}}">Dashboard</a></li>

        {{--<li class="uk-parent">--}}
            {{--<a href="#">Messaging</a>--}}
            {{--<ul class="uk-nav-sub">--}}
                {{--<li><a href="{{url('messaging/quick-sms')}}">Quick SMS</a></li>--}}
                {{--<li><a href="{{url('messaging/bulk-sms')}}">Bulk SMS</a>--}}
                {{--<li><a href="{{url('messaging/file2sms')}}">File 2 SMS</a>--}}
                    {{--<ul>--}}
                        {{--<li><a href="#">Excel 2 SMS</a></li>--}}
                        {{--<li><a href="#">CSV 2 SMS</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</li>--}}
        {{--<li class="uk-parent">--}}
            {{--<a href="#">Address Book</a>--}}
            {{--<ul class="uk-nav-sub">--}}
                {{--<li class="{{markActive($urlPath, 'address-book')}}"><a href="{{url('address-book')}}">All Contacts</a></li>--}}
                {{--<li class="{{markActive($urlPath, 'address-book/groups')}}"><a href="{{url('address-book/groups')}}">Groups</a></li>--}}
            {{--</ul>--}}
        {{--</li>--}}

        <li class="{{mark_active($urlPath, 'messaging/quick-sms')}}"><a href="{{url('messaging/quick-sms')}}">Quick SMS</a></li>
        <li class="{{mark_active($urlPath, 'messaging/bulk-sms')}}"><a href="{{url('messaging/bulk-sms')}}">Bulk SMS</a>
        <li class="{{mark_active($urlPath, 'messaging/file2sms')}}"><a href="{{url('messaging/file2sms')}}">File 2 SMS</a>

        <li class="uk-nav-divider"></li>

        <li class="{{mark_active($urlPath, 'address-book')}}"><a href="{{url('address-book')}}">All Contacts</a></li>
        <li class="{{mark_active($urlPath, 'address-book/groups')}}"><a href="{{url('address-book/groups')}}">Groups</a></li>

        <li class="uk-nav-divider"></li>

        <li class="{{mark_active($urlPath, 'messaging/sent-sms')}}"><a href="{{url('messaging/sent-sms')}}">Sent Messages</a></li>
        <li class="{{mark_active($urlPath, 'messaging/saved-sms')}}"><a href="{{url('messaging/saved-sms')}}">Draft Messages</a></li>

        {{--<li class="uk-nav-header">Header</li>--}}
        {{--<li class="uk-parent">--}}
            {{--<a href="#"><i class="uk-icon-star"></i> Parent</a>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<a href="#"><i class="uk-icon-twitter"></i> Item</a>--}}
        {{--</li>--}}

        {{--<li class="uk-nav-divider"></li>--}}

        {{--<li><a href="#"><i class="uk-icon-rss"></i> Item</a></li>--}}
    </ul>
</div>