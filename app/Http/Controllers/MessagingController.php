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


    public function postQuickSms(SendSmsRequest $request)
    {

        //gather data || take schedule_date n schedule_time
        $data = $request->only('sender', 'recipients', 'message', 'flash');

        $this->dispatch(
            new QuickSms(Auth::user(), $data['sender'], $data['recipients'], $data['message'], $data['schedule'], $data['flash'])
        );

        flash()->overlay("Message Sent. Please check sent message for delivery status", "Message Sent");
        return redirect()->route('quick_sms');
    }


    public function bulkSms()
    {

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
        //dd($data);
        return view('messaging.sent-sms', ['data'=>$data]);
    }

    public function sentSmsId($id=null, SmsHistoryRepository $repository)
    {
        if (is_null($id)):
            flash()->error('An unexpected error has occurred.');
            return redirect()->back();
        endif;

        $data = $repository->sentSmsId($id);
        //dd($repository->sentSmsId($id));
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

}
