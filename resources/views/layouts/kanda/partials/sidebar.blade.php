<div class="ui fluid vertical menu" style="margin-bottom: 20px;">
    {{--<div class="item">--}}
        {{--<div class="ui input"><input type="text" placeholder="Search..."></div>--}}
    {{--</div>--}}

    <a class="item" href="{{$sideMenu->dashboard}}">
        <i class="dashboard icon"></i> Dashboard
    </a>

    <div class="item">
        Messaging
        <div class="menu">
            <a class="item" href="{{$sideMenu->quick_sms}}">Quic SMS</a>
            <a class="item" href="#">Bulk SMS</a>
        </div>
    </div>

    <div class="item">
        AddressBook
        <div class="menu">
            <a class="item" href="{{$sideMenu->contacts}}">Contacts</a>
            <a class="item" href="{{$sideMenu->groups}}">Groups</a>
        </div>
    </div>

    <a class="item" href="{{$sideMenu->sent_messages}}">
        <i class="history icon"></i> Sent Messages
    </a>

    <a class="item" href="{{$sideMenu->draft_messages}}">
        <i class="archive icon orange"></i> Draft Messages
    </a>

    {{--<div class="item">--}}
        {{--Home--}}
        {{--<div class="menu">--}}
            {{--<a class="active item">Search</a>--}}
            {{--<a class="item">Add</a>--}}
            {{--<a class="item">Remove</a>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<a class="item">--}}
        {{--<i class="grid layout icon"></i> Browse--}}
    {{--</a>--}}

    {{--<a class="item">--}}
        {{--Messages--}}
    {{--</a>--}}

    {{--<div class="ui dropdown item">--}}
        {{--More--}}
        {{--<i class="dropdown icon"></i>--}}
        {{--<div class="menu">--}}
            {{--<a class="item"><i class="edit icon"></i> Edit Profile</a>--}}
            {{--<a class="item"><i class="globe icon"></i> Choose Language</a>--}}
            {{--<a class="item"><i class="settings icon"></i> Account Settings</a>--}}
        {{--</div>--}}
    {{--</div>--}}
</div>