<div class="span3">
    <div class="sidebar">


        <ul class="widget widget-menu unstyled">
            <li class="active">
                <a href="{{url('')}}">
                    <i class="fa fa-dashboard"></i>Dashboard
                </a>
            </li>
            <li><a href="{{url('messaging/quick-sms')}}"><i class="fa fa-fighter-jet"></i>Quick SMS</a></li>
            <li><a href="{{url('messaging/bulk-sms')}}"><i class="fa fa-cubes"></i>Bulk SMS</a></li>
            <li><a href="{{url('messaging/file2sms')}}"><i class="fa fa-file-code-o"></i>File2SMS</a></li>
        </ul>


        <ul class="widget widget-menu unstyled">
            <li>
                <li><a href="{{url('messaging/sent-sms')}}"><i class="fa fa-send-o"></i> Sent Messages </a></li>
                <li><a href="{{url('messaging/saved-sms')}}"><i class="fa fa-floppy-o"></i> Saved Messages </a></li>
            </li>
        </ul>

        <ul class="widget widget-menu unstyled">
                    <li>
                        <li><a href="{{url('address-book')}}"><i class="fa fa-send-o"></i> Address Book</a></li>
                        <li><a href="#"><i class="fa fa-floppy-o"></i> Number Context </a></li>
                    </li>
                </ul>

        <ul class="widget widget-menu unstyled">
            <li>
                @if (Auth::check())
                <a href="{{url('user/logout')}}"><i class="menu-icon icon-signout"></i>Logout </a>
                @endif
            </li>
        </ul>
    </div>
</div>