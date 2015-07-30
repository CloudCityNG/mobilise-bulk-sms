<div class="uk-panel uk-panel-box uk-hidden-small" data-uk-sticky>
    <h3 class="uk-panel-title">Control Panel</h3>
    <ul class="uk-nav uk-nav-side uk-nav-parent-icon" data-uk-nav>
        <li class="uk-active"><a href="{{url('user/dashboard')}}">Dashboard</a></li>

        <li class="uk-parent">
            <a href="#">Messaging</a>
            <ul class="uk-nav-sub">
                <li><a href="{{url('messaging/quick-sms')}}">Quick SMS</a></li>
                <li><a href="#">Bulk SMS</a>
                <li><a href="#">File 2 SMS</a>
                    <ul>
                        <li><a href="#">Excel 2 SMS</a></li>
                        <li><a href="#">CSV 2 SMS</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="uk-parent">
            <a href="#">Address Book</a>
            <ul class="uk-nav-sub">
                <li><a href="{{url('address-book')}}">All Contacts</a></li>
                <li><a href="{{url('address-book/groups')}}">Groups</a></li>
            </ul>
        </li>

        <li><a href="{{url('messaging/sent-sms')}}">Sent Messages</a></li>
        <li><a href="#">Draft Messages</a></li>

        <li class="uk-nav-header">Header</li>
        <li class="uk-parent">
            <a href="#"><i class="uk-icon-star"></i> Parent</a>
        </li>
        <li>
            <a href="#"><i class="uk-icon-twitter"></i> Item</a>
        </li>

        <li class="uk-nav-divider"></li>

        <li><a href="#"><i class="uk-icon-rss"></i> Item</a></li>
    </ul>
</div>