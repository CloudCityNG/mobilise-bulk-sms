<div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="index.html">Mobilise Bulk SMS </a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav nav-icons">
                            <li class="active"><a href="#"><i class="icon-envelope"></i></a></li>
                            <li><a href="#"><i class="icon-eye-open"></i></a></li>
                            <li><a href="#"><i class="icon-bar-chart"></i></a></li>
                        </ul>
                        <form class="navbar-search pull-left input-append" action="#">
                        <input type="text" class="span3">
                        <button class="btn" type="button">
                            <i class="icon-search"></i>
                        </button>
                        </form>
                        <ul class="nav pull-right">
                            <!--
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Item No. 1</a></li>
                                    <li><a href="#">Don't Click</a></li>
                                    <li class="divider"></li>
                                    <li class="nav-header">Example Header</li>
                                    <li><a href="#">A Separated link</a></li>
                                </ul>
                            </li>
                            -->
                            @if ( !empty($currentUser) )

                            <li><a href="#">Balance <span class="badge badge-info">{{$currentUser->smscredit->available_credit}}</span> Units </a></li>

                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="/code/images/user.png" class="nav-avatar" />
                                <b class="caret"></b></a>

                                <ul class="dropdown-menu">
                                    <li><a href="#">Your Profile [{{$currentUser->username}}]</a></li>
                                    <li><a href="#">Edit Profile</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Account Settings</a></li>
                                    <li><a href="#">Price list &amp; coverage</a></li>
                                    <li><a href="#">Payments</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{url('user/logout')}}">Logout</a></li>
                                </ul>

                            </li>
                            @else
                            <li><a href="{{url('user/login')}}">Login </a></li>
                            @endif
                        </ul>
                    </div>
                    <!-- /.nav-collapse -->
                </div>
            </div>
            <!-- /navbar-inner -->
        </div>