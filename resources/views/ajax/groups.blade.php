<table class="uk-table uk-table-hover uk-table-condensed" id="group-table">
    <caption>All Groups</caption>
    <tbody>
        <tr>
            <th>Group name</th>
            <th>Group Count</th>
            <th>&nbsp;</th>
        </tr>
        @foreach($data as $group)
        <tr>
            <td>{{$group->group_name}}</td>
            <td>{{$group->contacts->count()}}</td>
            <td class="uk-clearfix contacts-dropdown" style="position: relative">
                <div data-uk-dropdown="{mode:'click'}">
                    <a href=""><i class="uk-icon-sort-down"></i> </a>
                    <div class="uk-dropdown">
                        <ul class="uk-nav uk-nav-dropdown">
                            <li><a href="" class="" id="view" data-id="{{$group->id}}">View Contacts</a></li>
                            <li><a href="" class="" id="add" data-id="{{$group->id}}">Add Contact</a></li>
                            <li><a href="" class="" id="upload" data-id="{{$group->id}}">Upload Contacts</a></li>
                        </ul>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>