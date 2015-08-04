<?php namespace App\Http\Controllers;

use App\Commands\QuickSms;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\DraftSmsRequest;
use App\Http\Requests\SendSmsRequest;
use App\Lib\Services\Date\ProcessDate;
use App\Lib\Sms\SmsInfobip;
use App\Repository\SmsCreditRepository;
use App\Repository\SmsHistoryRepository;
use App\Models\Sms\SmsHistory;
use App\Models\Sms\SmsHistoryRecipient;
use App\Repository\SmsDraftRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagingController extends Controller {


    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('smscreditcheck', ['only' => ['postQuickSms']]);
    }


    public function quickSms()
    {
        return view('messaging.quick-sms');
    }


    public function postQuickSms(SendSmsRequest $request, ProcessDate $processDate)
    {
        //dd($request->all());
        $datetime = $processDate->processDateTime($request->get('schedule_date'), $request->get('schedule_time'));
        $this->dispatchFrom('App\Commands\QuickSms', $request, ['schedule'=>$datetime, 'user'=>Auth::user()]);
        flash()->overlay("Message Sent. Please check sent message for delivery status", "Message Sent");
        return redirect()->route('quick_sms');
    }


    public function bulkSms()
    {
        return view('messaging.bulk-sms');
    }


    public function postBulkSms()
    {

    }


    public function file2sms()
    {

    }


    public function postFile2sms()
    {

    }


    public function sentSms(SmsHistoryRepository $repository)
    {
        $data = $repository->sentSms();
        return view('messaging.sent-sms', ['data'=>$data]);
    }


    public function delSentSms($id, Request $request, SmsHistoryRepository $repository)
    {
        if ( $request->ajax() )
        {
            if ( $repository->del($id) )
                return response()->json(['success'=>true]);
            else
                return response()->json(['error'=>true], 422);
        }
    }


    public function sentSmsId($id=null, SmsHistoryRepository $repository)
    {
        if (is_null($id)):
            flash()->error('An unexpected error has occurred.');
            return redirect()->back();
        endif;
        $data = $repository->sentSmsId($id);
        return view('messaging.sent-sms-id', ['data'=>$data]);

    }


    public function savedSms(SmsDraftRepository $draftRepository)
    {
        $data = $draftRepository->paginate();
        return view('messaging.saved-sms', ['data'=>$data]);
    }


    public function postDraftSms(DraftSmsRequest $draftSmsRequest, ProcessDate $processDate)
    {
        $datetime = $processDate->processDateTime($draftSmsRequest->get('schedule_date'), $draftSmsRequest->get('schedule_time'));
        $this->dispatchFrom('App\Commands\NewDraftSmsCommand', $draftSmsRequest, ['schedule'=>$datetime]);
        flash()->success("Message saved as draft successfully");
        return redirect()->route('quick_sms');
    }


    public function delDraftSMS($id, Request $request, SmsDraftRepository $repository)
    {
        if ( $request->ajax() )
        {
            //$this->validate($request, ['id'=>'required|numeric']);
            if ( $repository->del($id) )
                return response()->json(['success'=>true]);
            else
                return response()->json(['error'=>true], 422);
        }

    }

}
