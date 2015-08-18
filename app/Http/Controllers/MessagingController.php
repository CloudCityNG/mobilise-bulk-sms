<?php namespace App\Http\Controllers;

use App\Commands\QuickSms;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\BulkSmsFileUploadRequest;
use App\Http\Requests\BulkSmsRequest;
use App\Http\Requests\DraftSmsRequest;
use App\Http\Requests\SendSmsRequest;
use App\Lib\Filesystem\CsvReader;
use App\Lib\Services\Date\ProcessDate;
use App\Lib\Sms\SmsInfobip;
use App\Repository\ContactRepository;
use App\Repository\GroupRepository;
use App\Repository\SmsCreditRepository;
use App\Repository\SmsHistoryRepository;
use App\Models\Sms\SmsHistory;
use App\Models\Sms\SmsHistoryRecipient;
use App\Repository\SmsDraftRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagingController extends Controller
{


    /**
     * Protect all methods form guests
     * check sms credit unit before sending SMS
     */
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('smscreditcheck', ['only' => ['postQuickSms', 'postQuickModalSms']]);
        $this->middleware('bulksms.checkcredit', ['only' => ['postBulkSms']]);
    }


    /**
     * Quick SMS form
     * @return \Illuminate\View\View
     */
    public function quickSms()
    {
        return view('messaging.quick-sms');
    }


    /**
     * Send a quick-sms from a POST request
     * @param SendSmsRequest $request
     * @param ProcessDate $processDate
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postQuickSms(SendSmsRequest $request, ProcessDate $processDate)
    {
        $others = ['user' => Auth::user()];
        if ( !$request->get('schedule') )
            $others['schedule'] = null;

        $this->dispatchFrom('App\Commands\QuickSms', $request, $others);
        flash()->overlay("Message Sent. Please check sent message for delivery status", "Message Sent");
        return redirect()->route('quick_sms');
    }


    /**@TODO merge send quick-sms AJAX with normal WEB request.
     * Send a quick-sms via AJAX.
     * @param SendSmsRequest $request
     * @param ProcessDate $processDate
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postQuickModalSms(SendSmsRequest $request, ProcessDate $processDate)
    {
        //dd($request->all());
        if ($request->ajax()) {
            $datetime = $processDate->processDateTime($request->get('schedule_date'), $request->get('schedule_time'));
            $this->dispatchFrom('App\Commands\QuickSms', $request, ['schedule' => $datetime, 'user' => Auth::user(), 'flash' => 0]);
            return response()->json(['success' => true]);
        }
    }


    /**
     * Bulk-SMS form
     * @param GroupRepository $groupRepository
     * @param ContactRepository $contactRepository
     * @return \Illuminate\View\View
     */
    public function bulkSms(GroupRepository $groupRepository, ContactRepository $contactRepository)
    {
        return view('messaging.bulk-sms', ['groups' => $groupRepository->getAllGroups(), 'contacts' => $contactRepository->getAllContactsNotInGroup()]);
    }


    public function postBulkSms(BulkSmsRequest $request)
    {
        dd($request->all());
        //get contacts gsm in group
        //get contacts gsm
    }


    public function postFileUpload(BulkSmsFileUploadRequest $request, CsvReader $reader)
    {
        //dd($request->file('files'));
        //validate the file
        //$path = storage_path('uploads/bulk-sms');
        $files = $request->file('files');
        foreach ($files as $file):
            if ($file->isValid())
                return response()->json(['success' => true, 'out' => $reader->readTxt($file)]);
        endforeach;

        return response()->json(['error' => true], 422);
    }


    public function file2sms()
    {

    }


    public function postFile2sms()
    {

    }


    /**
     * Sent SMS view
     * @param SmsHistoryRepository $repository
     * @return \Illuminate\View\View
     */
    public function sentSms(SmsHistoryRepository $repository)
    {
        $data = $repository->sentSms();
        return view('messaging.sent-sms', ['data' => $data]);
    }


    public function getSentSms($id, Request $request, SmsHistoryRepository $repository)
    {
        if ($request->ajax()) {
            $q = $repository->getSentSms($id);
            if ($q->count()) {
                return response()->json(['success' => true, 'out' => $q->get()]);
            } else
                return response()->json(['error' => true], 422);
        }
    }


    /**
     * Delete a sent SMS row via AJAX
     * @param $id
     * @param Request $request
     * @param SmsHistoryRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delSentSms($id, Request $request, SmsHistoryRepository $repository)
    {
        if ($request->ajax()) {
            if ($repository->del($id))
                return response()->json(['success' => true]);
            else
                return response()->json(['error' => true], 422);
        }
    }


    /**
     *
     * @param null $id
     * @param SmsHistoryRepository $repository
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function sentSmsId($id = null, SmsHistoryRepository $repository)
    {
        if (is_null($id)):
            flash()->error('An unexpected error has occurred.');
            return redirect()->back();
        endif;
        $data = $repository->sentSmsId($id);
        return view('messaging.sent-sms-id', ['data' => $data]);
    }


    /**
     * get delivery report via a sms_history_id via AJAX
     * @param $id
     * @param Request $request
     * @param SmsHistoryRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getDlr($id, Request $request, SmsHistoryRepository $repository)
    {
        if ($request->ajax()) {
            $data = $repository->getDlr($id);
            $out = view('ajax.dlr', ['data' => $data])->render();
            return response()->json(['success' => true, 'html' => $out]);
        }
    }


    /**
     * Show/Paginate Draft SMS
     * @param SmsDraftRepository $draftRepository
     * @return \Illuminate\View\View
     */
    public function savedSms(SmsDraftRepository $draftRepository)
    {
        $data = $draftRepository->paginate();
        return view('messaging.saved-sms', ['data' => $data]);
    }


    /**
     * Create an SMS Draft from a POST request.
     * @param DraftSmsRequest $draftSmsRequest
     * @param ProcessDate $processDate
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDraftSms(DraftSmsRequest $draftSmsRequest, ProcessDate $processDate)
    {
        $datetime = $processDate->processDateTime($draftSmsRequest->get('schedule_date'), $draftSmsRequest->get('schedule_time'));
        $this->dispatchFrom('App\Commands\NewDraftSmsCommand', $draftSmsRequest, ['schedule' => $datetime]);
        flash()->success("Message saved as draft successfully");
        return redirect()->route('quick_sms');
    }


    /**
     * Delete a draft SMS row by its id || Served over AJAX
     * @param $id
     * @param Request $request
     * @param SmsDraftRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delDraftSMS($id, Request $request, SmsDraftRepository $repository)
    {
        if ($request->ajax()) {
            if ($repository->del($id))
                return response()->json(['success' => true]);
            else
                return response()->json(['error' => true], 422);
        }
    }


    /**
     * Get a draft SMS row by ID. || Server over AJAX
     * @param $id
     * @param Request $request
     * @param SmsDraftRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getDraftSMS($id, Request $request, SmsDraftRepository $repository)
    {
        if ($request->ajax()) {
            $out = $repository->get($id);
            if ($out->count())
                return response()->json(['success' => true, 'out' => $out->get()]);
            else
                return response()->json(['error' => true], 422);
        }
    }

}
