@if($data)
    <div class="row">
        <div class="col-md-4 text-center">
            <div class="row"><h5>Valid Recipients</h5></div>
            <div class="row"><p>{{count($data['valid'])}}</p></div>
        </div>
        <div class="col-md-4 text-center">
            <div class="row"><h5>Invalid Recipients</h5></div>
            <div class="row"><p>{{count($data['invalid'])}}</p></div>

        </div>
        <div class="col-md-4 text-center">
            <div class="row"><h5>Duplicates</h5></div>
            <div class="row"><p>{{count($data['duplicates'])}}</p></div>
        </div>
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr class="text-center">
                    <th class="text-center">Country|Network</th>
                    <th class="text-center">Price per SMS</th>
                    <th class="text-center">Total Recipients</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data['data'] as $row => $value)
                    <tr class="text-center">
                        <td>{{$row}}</td>
                        <td>{{$value['price']}}</td>
                        <td>{{$value['total_recipients']}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif