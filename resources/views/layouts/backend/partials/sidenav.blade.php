
<div class="ui vertical fluid menu" id="sidebar">

    <div class="item">
        <a class="item active" href="{{url('backend')}}">Dashboard</a>
    </div>

    <div class="item">
        <div class="header">Messaging</div>
        <div class="menu">
            <a class="item" href="{{url('backend/quic-sms')}}"><i class="send icon"></i>Quick SMS</a>
            <a class="item"><i class="text telephone icon"></i>Bulk SMS</a>
        </div>
    </div>

    <div class="item">
        <div class="header">Address Book</div>
        <div class="menu">
            <a class="item"><i class="user icon"></i>Contacts</a>
            <a class="item"><i class="users icon"></i>Groups</a>
        </div>
    </div>

    <div class="item">
        <div class="header">Records</div>
        <div class="menu">
            <a class="item"><i class="history icon"></i>Sent SMS <div class="ui blue left label">51</div></a>
            <a class="item"><i class="archive icon"></i>Draft SMS <div class="ui teal left label">12</div></a>
        </div>
    </div>

    <div class="item">
        <div class="header">Support</div>
        <div class="menu">
            <a class="item"><i class="lab icon"></i>E-mail Support</a>
            <a class="item"><i class="announcement icon"></i>FAQs</a>
        </div>
    </div>
</div>