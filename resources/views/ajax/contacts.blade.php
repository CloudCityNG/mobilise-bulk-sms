<table class="uk-table uk-table-hover uk-table-condensed" id="contact-table">
    <caption>All Contacts</caption>
    <tbody>
        <tr>
            <th>Contact name</th>
            <th>Contact email</th>
            <th>Mobile number</th>
            <th>&nbsp;</th>
        </tr>
        @foreach($data as $contact)
        <tr id="{{$contact->id}}" class="row">
            <td id="firstname">{{$contact->firstname}}</td>
            <td id="email">{{$contact->email}}</td>
            <td id="gsm">{{$contact->gsm}}</td>
            <td class="uk-clearfix contacts-dropdown" style="position: relative">
                <div data-uk-dropdown="{mode:'click'}">
                    <a href=""><i class="uk-icon-sort-down"></i> </a>
                    <div class="uk-dropdown">
                        <ul class="uk-nav uk-nav-dropdown">
                            <li><a href="" class="" id="send" data-id-send="{{$contact->id}}">Send SMS</a></li>
                            <li><a href="" class="edit-{{$contact->id}}" id="edit" data-id-edit="{{$contact->id}}">Edit</a></li>
                            <li><a href="" class="delete-{{$contact->id}}" id="delete" data-id-delete="{{$contact->id}}">Delete</a></li>
                        </ul>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>