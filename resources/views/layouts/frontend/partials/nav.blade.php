<nav class="tm-navbar uk-navbar uk-navbar-attached">
    <div class="uk-container uk-container-center">

        <a class="uk-navbar-brand uk-hidden-small" href="/"><img class="uk-margin uk-margin-remove" src="/images/logos/quic-sms.png" width="100" title="Quic-SMS" alt="Quic-SMS"></a>

        <ul class="uk-navbar-nav uk-hidden-small">
            <li><a href="{{url('address-book')}}">Address Book</a></li>
            <li><a href="#">Messaging</a></li>
            <li><a href="#">Manage Account</a></li>
            <li><a href="#">Billing</a></li>
            <li><a href="#">My Settings</a></li>
            <li><a href="#">Help</a></li>
        </ul>
        <div class="uk-navbar-content uk-navbar-flip  uk-hidden-small">
            <ul class="uk-navbar-nav uk-hidden-small">
            <li class="uk-parent" data-uk-dropdown>
                <a href="">{{ucfirst($currentUser->username)}} <i class="uk-icon-caret-down"></i></a>
                <div class="uk-dropdown uk-dropdown-navbar">
                    <ul class="uk-nav uk-nav-navbar">
                        <li><a href="#">{{$currentUser->smscredit->available_credit}} Credit</a></li>
                        <li class="uk-nav-header">My Account</li>
                        <li><a href="{{url('user/change-password')}}">Change Password</a>
                        <li><a href="{{url('user/account-setting')}}">Account Setting</a>
                        <li><a href="#">Account Preference</a>
                        <li><a href="#">Send SMS Credit</a>
                        <li class="uk-nav-header">Contact Us</li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">Support</a></li>
                        <li class="uk-nav-divider"></li>
                        <li><a href="{{url('user/logout')}}">Log Out</a></li>
                    </ul>
                </div>

            </li>
            </ul>
        </div>
        <a href="#tm-offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas=""></a>
        <div class="uk-navbar-brand uk-navbar-center uk-visible-small"><img src="/images/logos/quic-sms.png" width="90" height="30" title="UIkit" alt="UIkit"></div>

    </div>
</nav>