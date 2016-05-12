@inject('handler', 'App\Lib\Sms\DlrHandler')
<?php
$total = 0;
$out = null;
$delivered = 0;
$rejected = 0;
$expired = 0;
$not_delivered = 0;
$others = 0;

foreach ( $data as $row ):
    $total++;

    if ( strtolower($row->status) == 'delivered' )
        $delivered++;
    if ( strtolower($row->status) == 'expired' )
        $expired++;
    if ( strtolower($row->status) == 'rejected' )
        $rejected++;
    if ( strtolower($row->status) == 'not_delivered' )
        $not_delivered++;




    $out .= "<p>" . $row->destination . " | " . $handler->translate_status($row->status) . "</p>";

endforeach;
?>
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
    <div>
        <span style="text-decoration: underline">Summary</span><br>
        @if($total)
            <span>Total: {{$total}}</span><br>
        @endif

        @if($delivered)
            <span>Delivered: {{$delivered}}</span><br>
        @endif

        @if($expired)
            <span>Expired: {{$expired}}</span><br>
        @endif

        @if($rejected)
            <span>Rejected: {{$rejected}}</span><br>
        @endif

        @if($not_delivered)
            <span>Not Delivered: {{$not_delivered}}</span><br>
        @endif

        @if($total && ( $expired || $rejected || $not_delivered ))
            <span>Others: {{$total - ($delivered + $expired + $rejected + $not_delivered)}}</span><br>
        @endif




        {!! $out !!}
    </div>

    </body>
</html>
