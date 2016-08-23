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
                <?php $total_recipients = $total_units = 0;?>
                @foreach($data['data'] as $row => $value)
                    <tr class="text-center">
                        <td>{{$row}}</td>
                        <td>{{$value['price']}}</td>
                        <td>{{$value['total_recipients']}}</td>
                        <?php
                            $total_recipients += $value['total_recipients'];
                            $total_units += ($value['price'] * $value['total_recipients']);
                        ?>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <table class="table">
                <thead>
                <tr>
                    <th class="text-center">Total SMS</th>
                    <th class="text-center">Total Units</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-center">{{number_format($total_recipients * $data['sms_pages'])}}</td>
                    <td class="text-center">{{number_format($data['sms_pages'] * $total_units)}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endif