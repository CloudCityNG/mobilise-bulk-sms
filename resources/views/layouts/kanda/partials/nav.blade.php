
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
    <a class="item"><i class="mail icon"></i> Messaging</a>
    <a class="item"><i class="book icon"></i> AddressBook</a>
    <a class="item"><i class="announcement icon"></i> Support</a>

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
                <i class="money icon"></i> 200
              </div>
              <a class="ui left pointing blue label" href="{{url('user/credit-purchase')}}">
                Buy Credits
              </a>
            </div>
        </div>

        <div class="ui dropdown item" tabindex="0">
            <i class="options icon"></i> Username
                <i class="dropdown icon"></i>
                <div class="menu transition hidden" tabindex="-1">
                    <div class="item">Settings</div>
                    <div class="item">Something else here</div>
                    <div class="divider"></div>
                    <div class="item">Separated Link</div>
                    <div class="divider"></div>
                    <div class="item">Logout</div>
                </div>
        </div>
    </div>
</div>