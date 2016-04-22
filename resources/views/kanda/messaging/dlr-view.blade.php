<!DOCTYPE html>
    <head>
        <title>Delivery report</title>
    </head>
    <style type="text/css">
    body{
    font-family: verdana, sans-serif;
    font-size: 11px;
    }
    </style>
    <body>
    @foreach($data as $row)

    <p>{{$row->destination}} |  {{App\Lib\Sms\DlrHandler::translate_status($row->status)}}</p>

    @endforeach
    </body>
</html>
