
<!-- Sidebar Menu -->


<div class="ui secondary fluid menu" id="quic-main-menu">

    <a class="toc item">
      <i class="sidebar icon"></i>
    </a>

    <div class="item quic-logo">
        <a href="/">
            <img src="{{getenv('LOGO_URL')}}" alt="" style="width: 150px"/>
        </a>
    </div>
    <a class="item" href="{{$sideMenu->quick_sms}}"><i class="mail icon"></i> Messaging</a>
    <a class="item" href="{{url('address-book')}}"><i class="book icon"></i> AddressBook</a>
    <a class="item" href="{{$sideMenu->support}}"><i class="announcement icon"></i> Support</a>

    <div class="right menu">
    {{--<div class="item">--}}
      {{--<div class="ui action left icon input">--}}
        {{--<i class="search icon"></i>--}}
        {{--<input type="text" placeholder="Search">--}}
        {{--<button class="ui button">Submit</button>--}}
      {{--</div>--}}
    {{--</div>--}}
        <div class="item quic-label-button">
            <div class="ui labeled button" tabindex="0">
              <div class="ui basic blue button">
                <i class="money icon"></i> {{$currentUser->smscredit->available_credit}}
              </div>
              <a class="ui left pointing blue label" href="{{url('user/credit-purchase')}}">
                Buy Credits
              </a>
            </div>
        </div>


        <div class="ui dropdown item">
            <i class="options icon"></i> {{ucfirst($currentUser->username)}}
                <i class="dropdown icon"></i>
                <div class="menu transition hidden" tabindex="-1">
                    <div class="item"><a href="{{$sideMenu->dashboard}}"> <i class="dashboard icon"></i> Dashboard</a></div>
                    <div class="item"><a href="{{$sideMenu->account_setting}}"> <i class="settings icon"></i> Settings</a></div>
                    <div class="item"> <i class="user icon"></i> Profile</div>
                    <div class="divider"></div>
                    <div class="item"><a href="{{$sideMenu->payments}}"> <i class="payment icon"></i> Payments</a></div>
                    <div class="divider"></div>
                    <div class="item"><a href="{{url('user/logout')}}"> <i class="sign out icon"></i> Logout</a></div>
                </div>
        </div>
    </div>
</div>