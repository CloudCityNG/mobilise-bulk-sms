<table class="uk-table uk-table-hover uk-table-condensed" id="show-group-contacts">
    <tr>
        <th>Firstname</th>
        <th>Gsm</th>
    </tr>
    @foreach($data as $contact)
    <tr>
        <td>{{$contact->firstname}}</td>
        <td>{{$contact->gsm}}</td>
    </tr>
    @endforeach
</table>