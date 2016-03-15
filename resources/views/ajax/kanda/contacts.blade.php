        @foreach($data as $contact)
        <div class="card">
            <div class="content">
                <div class="header">{{$contact->firstname}}</div>
                <div class="meta">M: {{$contact->gsm}}</div>
                @if ($contact->gsm2)
                <div class="meta">H: {{$contact->gsm2}}</div>
                @endif
            </div>
            <div class="extra content">
                <small>
                <a href="#">Send SMS</a> |
                <a href="#">View</a> |
                <a href="#">Delete</a>
                </small>
            </div>
        </div>
        @endforeach