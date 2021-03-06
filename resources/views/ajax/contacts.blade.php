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
                    <a href="" class="uk-button"><i class="uk-icon-sort-down"></i> </a>
                    <div class="uk-dropdown">
                        <ul class="uk-nav uk-nav-dropdown">
                            <li><a href="" class="" id="send" data-send-id="{{$contact->id}}" data-send-msisdn="{{$contact->gsm}}">Send SMS</a></li>
                            <li><a href="" class="edit-{{$contact->id}}" id="edit" data-edit-id="{{$contact->id}}">Edit</a></li>
                            <li><a href="" id="add" data-add-id="{{$contact->id}}">Add to group</a></li>
                            <li><a href="" class="delete-{{$contact->id}}" id="delete" data-delete-id="{{$contact->id}}">Delete</a></li>
                        </ul>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>