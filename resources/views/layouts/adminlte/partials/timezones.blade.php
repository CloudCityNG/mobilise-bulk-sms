@foreach(tz_list() as $t)
    <option value="{{$t['diff_from_GMT']}}">{{$t['zone'] . '  ' . $t['diff_from_GMT']}}</option>
@endforeach