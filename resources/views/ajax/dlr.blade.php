@foreach($data as $row)
<table class="uk-table uk-table-hover uk-table-condensed" id="group-table">
    <tr>
        <th>number</th>
        <th>status</th>
        <th>messageid</th>
    </tr>
    @foreach($row->smshistoryrecipient as $recipient)
    <tr>

        <td>{{$recipient->destination}}</td>
        <td>{{$recipient->status}}</td>
        <td>{{$recipient->messageid}}</td>

    </tr>
    @endforeach
</table>
@endforeach