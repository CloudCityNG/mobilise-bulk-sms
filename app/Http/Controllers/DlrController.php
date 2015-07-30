<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Dlr;
use DOMDocument;
use DOMXPath;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DlrController extends Controller {


    public function collector(Request $request, Dlr $dlr)
    {
        //read raw POST data
        $postData = file_get_contents("php://input");

        //extract xml structure from it using PHP's DoMDocument object model parser
        $dom = new DOMDocument();
        $dom->loadXML($postData);

        //create new xpath object for quering XML element nodes
        $xPath = new DOMXPath($dom);

        //query "message" element
        $reports = $xPath->query("/DeliveryReport/message");

        //write out attributes of each message element
        foreach ($reports as $node) {

            $messageid = $node->getAttribute('id');
            $sentdate = $node->getAttribute('sentdate');
            $donedate = $node->getAttribute('donedate');
            $status = $node->getAttribute('status');
            $gsmerrorcode = $node->getAttribute('gsmerrorcode');

            $dlr->make([
                'messageid'     => $messageid,
                'sentdate'      => $sentdate,
                'donedate'      => $donedate,
                'status'        => $status,
                'gsmerrorcode'  => $gsmerrorcode,
            ]);

            DB::table('sms_history_recipients')
                ->where('messageid', $messageid)
                ->update([
                    'sentdate'      => $sentdate,
                    'donedate'      => $donedate,
                    'status'        => $status,
                    'gsmerrorcode'  => $gsmerrorcode,
                ]);

        }
    }

}
