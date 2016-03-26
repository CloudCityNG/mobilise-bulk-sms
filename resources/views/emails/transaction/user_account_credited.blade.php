@extends('emails.layouts.new')

@section('content')
<table cellpadding="0" cellspacing="0" width="100%" bgcolor="#ffffff">
    <tr>
        <td valign="top" style="padding-bottom:15px; background-color:#ffffff;">
            <h1>Credit Purchase.</h1>
        </td>
    </tr>

    <tr>
        <td valign="top" style="padding-bottom:20px; background-color:#ffffff;">
            <b>Your credit purchase was successful.</b><br>
            Please find the information below. <br><br>
            Your payment for {{$units}} SMS credit has been received.

            <ul>
                <li>Credit Unit: {{$units}} Units</li>
                <li>New Balance: {{$balance}} Units</li>
                <li>Amount Approved: NGN{{$amount}}</li>
                <li>Payment Channel: {{$payment_channel}}</li>
                <li>Transaction Reference: {{$transaction_ref}}</li>
            </ul>
        </td>
    </tr>

    <tr>
        <td>
            <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff">
                <tr>
                    <td style="width:200px;background:#2185D0;">
                        <div><!--[if mso]>
                            <v:rect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="#" style="height:40px;v-text-anchor:middle;width:200px;" stroke="f" fillcolor="#2185D0">
                                <w:anchorlock/>
                                <center>
                                <![endif]-->
                                    <a href="#" style="background-color:#2185D0;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:18px;line-height:40px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;">Happy Messaging!</a>
                                <!--[if mso]>
                                </center>
                            </v:rect>
                            <![endif]-->
                        </div>
                    </td>

                    <td width="360" style="background-color:#ffffff; font-size:0; line-height:0;">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td style="padding-top:20px;background-color:#ffffff;">
            Thank you so much,<br>
            QuicSMS team.
        </td>
    </tr>
</table>
@endsection