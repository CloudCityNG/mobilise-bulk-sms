<?php

namespace App\Lib\Sms;


use App\Models\Dlr;
use App\Models\Sms\SmsHistoryRecipient;
use App\Repository\SmsHistoryRepository;
use Illuminate\Database\Eloquent\Collection;

class DlrHandler {

    public function clean_table()
    {
        $zero_rows = SmsHistoryRecipient::where('status', 0)->get();

        foreach( $zero_rows as $row )
        {
            //fetch dlr
            $r = Dlr::where('messageid', $row->messageid)->first();
            if ($r)
            {
                $row->status = $r->status;
                $row->sentdate = $r->sentdate;
                $row->donedate = $r->donedate;
                $row->gsmerrorcode = $r->gsmerrorcode;
                $row->save();
                echo $row->id . '------done.' . "\n\r";
            }

            //update parent row
        }
    }


    public static function downloadDlr(Collection $data)
    {
        $contents = null;
        //loop through the $data collection
        foreach($data as $row)
        {
            $recipient = $row->destination;
            $status = (new self())->translate_status($row->status);
            $contents .= "$recipient | self::translate($status)" . "\n";
        }

        $filename = time() . ".txt";
        $file_path = storage_path("dlr/$filename");
        $file = file_put_contents($file_path, $contents);
        return response()->download( $file_path );
    }


    public static function translate_status($status)
    {
        $out = null;

        switch (trim($status))
        {
            case "0":
                $out = 'No response.';
                break;
            case "-1":
                $out = "Error processing request";
                break;
            case "-2":
                $out = "Insufficient credit";
                break;
            case "-3":
                $out = "Targeted network not covered";
                break;
            case "-13":
                $out = "Number not recognized";
                break;
            case "-26":
                $out = "General API error";
                break;
            case "-27":
                $out = "Invalid scheduling parameter";
                break;
            case "-34":
                $out = "Sender name not allowed";
                break;
            case "-99":
                $out = "Error processing request";
                break;

            case "NOT_SENT":
                $out = 'Not Sent';
                break;
            case "SENT":
                $out = 'Sent';
                break;
            case "NOT_DELIVERED":
                $out = 'Not Delivered';
                break;
            case "DELIVERED":
                $out = 'Delivered';
                break;
            case "NOT_ALLOWED":
                $out = 'Not Allowed';
                break;
            case "INVALID_DESTINATION_ADDRESS":
                $out = 'Invalid Destination Address';
                break;
            case "INVALID_SOURCE_ADDRESS":
                $out = 'Invalid Source Address';
                break;
            case "ROUTE_NOT_AVAILABLE":
                $out = 'Destination Route not Available';
                break;
            case "NOT_ENOUGH_CREDITS":
                $out = 'Insufficient Credit';
                break;
            case "REJECTED":
                $out = 'Rejected';
                break;
            case "INVALID_MESSAGE_FORMAT":
                $out = 'Invalid Message Address';
                break;
            case "EXPIRED":
                $out = 'Expired';
                break;
            default:
                $out = 'Status Unknown';
                break;
        }

        return $out;
    }




} 