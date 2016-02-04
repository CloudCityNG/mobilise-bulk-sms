
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

    <div class="right menu">
    {{--<div class="item">--}}
      {{--<div class="ui action left icon input">--}}
        {{--<i class="search icon"></i>--}}
        {{--<input type="text" placeholder="Search">--}}
        {{--<button class="ui button">Submit</button>--}}
      {{--</div>--}}
    {{--</div>--}}


        <div class="ui dropdown item" tabindex="0">
            <i class="options icon"></i> {{ucfirst($currentUser->username)}}
                <i class="dropdown icon"></i>
                <div class="menu transition hidden" tabindex="-1">
                    <div class="item">Settings</div>
                    <div class="item">Something else here</div>
                    <div class="divider"></div>
                    <div class="item">Separated Link</div>
                    <div class="divider"></div>
                    <div class="item"><a href="{{url('user/logout')}}">Logout</a></div>
                </div>
        </div>
    </div>
</div>