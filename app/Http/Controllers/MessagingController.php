<?php
namespace App\Http\Controllers;

use App\Http\Forms\DraftSmsForm;
use App\Http\Forms\FileToSmsForm;
use App\Http\Forms\QuicSmsForm;
use App\Jobs\BulkSmsCommand;
use App\Jobs\NewDraftSmsJob;
use App\Jobs\QuickSms;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\BulkSmsFileUploadRequest;
use App\Http\Requests\BulkSmsRequest;
use App\Http\Requests\DraftSmsRequest;
use App\Http\Requests\SendSmsRequest;
use App\Jobs\SendSmsJob;
use App\Lib\Filesystem\CsvReader;
use App\Lib\Services\Date\ProcessDate;
use App\Lib\Sms\DlrHandler;
use App\Repository\ContactRepository;
use App\Repository\GroupRepository;
use App\Repository\SmsHistoryRepository;
use App\Repository\SmsDraftRepository;
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
        $this->middleware('smscreditcheck', ['only' => ['confirmQuic', 'postQuickSms', 'postQuickModalSms', 'postSendSms']]);
//        $this->middleware('bulksms.checkcredit', ['only' => ['postBulkSms']]);
    }


    public function sendSms()
    {
        return view('bootswatch.messaging.send-sms');
    }


    public function postSendSms(QuicSmsForm $form)
    {
        $form->save();
        flash()->overlay("Please check delivery for massage status", "Message Queued for sending");
        return redirect()->back();
    }


    public function fileToSms()
    {
        return view('bootswatch.messaging.file-to-sms');
    }


    public function postFileToSms(FileToSmsForm $form)
    {
        $data = $form->save();
        flash()->timer($form->getNumberCount() . ' Contacts Uploaded');
        return view('bootswatch.messaging.file-to-sms-1', ['data' => $data, 'count' => $form->getNumberCount()]);
    }


    /**
     * Show/Paginate Draft SMS
     * @param SmsDraftRepository $draftRepository
     * @return \Illuminate\View\View
     */
    public function savedSms(SmsDraftRepository $draftRepository)
    {
        $data = $draftRepository->paginate();
        return view('bootswatch.messaging.draft-sms-list', ['data' => $data]);
        return view('kanda.messaging.draft-sms', ['data' => $data]);
    }


    /**
     * Create an SMS Draft from a POST request.
     * @param DraftSmsRequest $draftSmsRequest
     * @param ProcessDate $processDate
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDraftSms(DraftSmsForm $form, Request $request)
    {
        $form->save();
        flash()->success("Message saved as draft successfully");
        return redirect()->to('user/dashboard');
    }


    /**
     * @param $id
     * @param SmsDraftRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     * @internal param Request $request
     */
    public function getDraftSMS($id, SmsDraftRepository $repository)
    {
        $this->evaluateId($id);
        $data = $repository->get($id);
        return view('bootswatch.messaging.draft-sms', compact('data'));
    }


    /**
     * @param $id
     * @param Request $request
     * @param SmsDraftRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delDraftSMS($id, Request $request, SmsDraftRepository $repository)
    {
        if ($repository->del($id)):
            flash()->message("Draft message deleted");
        endif;
        return redirect()->route('draft_sms_list');
    }

    /**
     * Sent SMS view
     * @param SmsHistoryRepository $repository
     * @return \Illuminate\View\View
     */
    public function sentSms(SmsHistoryRepository $repository)
    {
        $data = $repository->sentSms();
        return view('bootswatch.messaging.sent-sms-list', ['data' => $data]);
    }


    /**
     * Show a full sent SMS message
     *
     * @param null $id
     * @param SmsHistoryRepository $repository
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function sentSmsId($id = null, SmsHistoryRepository $repository)
    {
        $this->evaluateId($id);
        $data = $repository->sentSmsId($id, false);
        if ( $data === null )
            return redirect()->route('sent_sms_list');
        return view('bootswatch.messaging.sent-sms', compact('data'));
    }


    /** Download DLR
     * @param null $id
     * @param SmsHistoryRepository $repository
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function sentSmsIdDlr($id = null, SmsHistoryRepository $repository)
    {
        $this->evaluateId($id);
        $data = $repository->sentSmsId($id);
        return DlrHandler::downloadDlr($data->smshistoryrecipient);
    }

    public function sentSmsDel($id = null, SmsHistoryRepository $repository)
    {
        $repository->del($id);
        flash()->success("Message deleted successfully");
        return redirect()->back();
    }




    /** Display Quic SMS Form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function quic()
    {
        return view('kanda.messaging.quicsms');
    }


    public function confirmQuic(SendSmsRequest $request)
    {
        //create session and store data
        $inputs = $request->all();
        //dd($inputs);
        return view('kanda.messaging.confirm-quicsms', ['data' => $inputs]);
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
    public function postQuickSms(SendSmsRequest $request)
    {
        //retrieve data from session and dispatch
        $this->dispatchFrom('App\Jobs\QuickSmsJob', $request, ['user_id' => $request->user()->id]);
        flash()->overlay("Message Sent. Please check sent messages for delivery status", "Message Sent");
        return redirect()->back();
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
            $this->dispatchFrom(QuickSms::class, $request, ['user' => Auth::user(), 'flash' => 0]);
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
        //dd($request->all());
        $this->dispatchFrom(BulkSmsCommand::class, $request, ['user' => Auth::user()]);
        flash()->overlay("Message Sent. Please check sent message for delivery status", "Message Sent");
        return redirect()->route('bulk_sms');
    }


    public function postFileUpload(BulkSmsFileUploadRequest $request, CsvReader $reader)
    {
        //dd($request->file('bulkSmsFile'));
        $file = $request->file('bulkSmsFile');

        if ($file->isValid())
            return response()->json(['success' => true, 'out' => $reader->readCsvNewLine($file)]);

        return response()->json(['error' => true], 422);
    }


    public function postFile2sms()
    {

    }


    public function postFileUpload2(BulkSmsFileUploadRequest $request, CsvReader $reader)
    {
        //validate the file
        $files = $request->file('bulkSmsFile');
        foreach ($files as $file):
            if ($file->isValid()):
                $out = $reader->csv_to_array($file);

                unset($out[0]);

                return response()->json(['success' => true, 'out' => $out]);
            endif;
        endforeach;
        //upload the file
        //read the file
        //send back contents of the file
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
            if ($repository->del($id, Auth::user()->id))
                return response()->json(['success' => true]);
            else
                return response()->json(['error' => true], 422);
        }
    }


    public function sentSmsIdDlrView($id, SmsHistoryRepository $repository)
    {
        $this->evaluateId($id);
        $data = $repository->sentSmsId($id)->smshistoryrecipient;
        //dd($data->smshistoryrecipient);
        return view('kanda.messaging.dlr-view', compact('data'));
    }


    public function sentSmsForward($id, SmsHistoryRepository $repository)
    {
        //fetch record
        $data = $repository->getSentSms($id);
        //send record to view
        return view('kanda.messaging.sent-sms-forward', compact('data'));
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


    private function evaluateId($id, $redirectUrl = null)
    {
        if (is_null($id)) {
            flash()->error('An unexpected error has occurred.');
            return $redirectUrl ? redirect()->to($redirectUrl) : redirect()->back();
        }
    }

}
