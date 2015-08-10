<table class="uk-table uk-table-hover uk-table-condensed" id="group-table">
    <caption>All Groups</caption>
    <tbody>
        <tr>
            <th>Group name</th>
            <th>Contact Count</th>
            <th>&nbsp;</th>
        </tr>
        @foreach($data as $group)
        <tr>
            <td>{{$group->group_name}}</td>
            <td id="count" data-count="{{$group->contacts->count()}}">{{$group->contacts->count()}}</td>
            <td>
                <div class="uk-button-group">
                    <button class="uk-button">Actions</button>
                    <div data-uk-dropdown="{mode:'click'}">
                        <a href="" class="uk-button"><i class="uk-icon-caret-down"></i></a>
                        <div class="uk-dropdown uk-dropdown-small">
                            <ul class="uk-nav uk-nav-dropdown">
                                <li><a href="#" class="" id="view" data-view-id="{{$group->id}}">View Contacts</a></li>
                                <li><a href="#" class="" id="add" data-add-id="{{$group->id}}">Add Contact</a></li>
                                <li><a href="#" class="" id="upload" data-upload-id="{{$group->id}}">Upload Contacts</a></li>
                                <li><a href="#" class="" id="delete" data-delete-id="{{$group->id}}">Delete Group</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>