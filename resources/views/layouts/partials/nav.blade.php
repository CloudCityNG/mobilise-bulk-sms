
<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Mobilise Bulk-SMS</a>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav main-navbar">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">About</a></li>

                @if (!empty($currentUser))
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Sms <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li>{!! link_to_route('new_sms_path','Send SMS') !!}</li>
                        <li>{!! link_to_route('draftsms_path', 'Draft SMS') !!}</li>
                        <li><a href="#">Create SMS Template</a></li>
                        <li class="divider"></li>
                        <li><a href="{!! action('SmsController@show',['id'=>null]) !!}">Sent SMS
                                    <span class='badge'>
                                        {!! $currentUser->sentsms->count() !!}
                                    </span></a> </li>
                        <li><a href="#">Saved Draft
                                <span class='badge'>{!! $currentUser->draftsms->count() !!}</span>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="#">Download Sent Messages (CSV)</a></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
                @endif
            </ul>


            <ul class="nav navbar-nav navbar-right main-navbar">
            @if (!empty($currentUser))
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">

                    <!-- <img class="nav-gravatar" src="" alt="{{ $currentUser->username }}" /> -->

                    {{ $currentUser->username }}<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li>
                        <a href="#">Available Credit: <span class="badge">{{ $currentUser->smscredit->first()->available_credit }}</span>
                        </a></li>
                        <li class="divider"></li>
                        <li>{!! link_to_route('logout_path', 'Log Out') !!}</li>
                    </ul>
                </li>
            @else
                <li>{!! link_to_route('register_path', 'Register') !!}</li>
                <li>{!! link_to_route('login_path', 'Log In') !!}</li>
            @endif
            </ul>

        </div>
    </div>
</nav>