@extends('emails.layouts.new')

@section('content')
<table cellpadding="0" cellspacing="0" width="100%" bgcolor="#ffffff">
    <tr>
        <td valign="top" style="padding-bottom:15px; background-color:#ffffff;">
            <h1>Welcome to QuicSMS</h1>
        </td>
    </tr>

    <tr>
        <td valign="top" style="padding-bottom:20px; background-color:#ffffff;">
            <b>Hey {{ $username }}, thanks for signing up!</b><br>
            We're really excited for you to join our community! Your account has been successfully created.<br><br>
            With QuicSMS you can now stay connected to the community with messaging.
            <ul>
            <li>Send smart SMS from your PC or Mobile device</li>
            <li>Schedule messages to your contacts</li>
            <li>Check delivery report for sent messages</li>
            <li>Get up to 100MB of space for message history</li>
            <li>Purchase credit units with ease</li>
            </ul>
            Simply have a nice time with messaging on QuicSMS
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
                                    <a href="#" style="background-color:#2185D0;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:18px;line-height:40px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;">Happy Messaging!.</a>
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