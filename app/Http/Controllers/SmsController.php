<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\DraftSmsRequest;
use App\Http\Requests\SendSmsRequest;
use App\Models\Sms\SmsHistory;
use App\Models\Sms\SmsCredit;
use App\Models\Sms\SmsCreditUsageRepository;
use App\Repository\SmsDraftRepository;
use App\Repository\SmsHistoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SmsController extends Controller {

    /**
     * @var SentSmsHistoryRepository
     */
    private $sentSmsHistoryRepository;
    /**
     * @var SmsCreditUsageRepository
     */
    private $creditUsageRepository;

    function __construct(SentSmsHistoryRepository $sentSmsHistoryRepository, SmsCreditUsageRepository $creditUsageRepository)
    {
        $this->middleware('auth');
        $this->middleware('creditcheck', ['only'=>['store','create']]);
        $this->sentSmsHistoryRepository = $sentSmsHistoryRepository;
        $this->creditUsageRepository = $creditUsageRepository;
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('sms.create');
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param SendSmsRequest $request
     * @return Response
     */
	public function store(SendSmsRequest $request)
	{
        $success = false;
        $user_id = Auth::user()->id;
		//validate

        //BILL
        DB::beginTransaction();
            $units = SmsHistoryRepository::getBill($request->get('recipients'), $request->get('message'));

            SmsCredit::billUserSmsCredit($units, $user_id);

            //send message
            $response = $this->sentSmsHistoryRepository->send_sms(
                $request->get('senderid'),
                $request->get('recipients'),
                $request->get('message'),
                $request->get('schedule')
            );

        if ( $response['succeed'] )
        {
            //save and commit.
            //dd($request->all());

            //bring in the repository to perform send & save
            extract($request->all());
            $sms = SentSmsHistory::store($senderid,$recipients,$message,$schedule,$response['response'],1,$units);
            $sms = $this->sentSmsHistoryRepository->save($sms, $user_id);

            //record sms credit usage history
            $this->creditUsageRepository->save($user_id,$sms->id,$units,'debit');

        DB::commit();
            $success = true;
        }
        else
        {
        DB::rollback();
        }

        if ( $success )
        {
            //flash response to user
            flash()->overlay('Your message has been sent', 'Violaaa');
            return Redirect::back();
        }
        else
        {
            flash()->error('Your message was not sent. Please try again.');
            //redirect user
            return Redirect::back()->withInput();
        }




	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id=null)
	{
		if ( is_null($id)) :
            //paginate all sent messages
            $data = $this->sentSmsHistoryRepository->paginate();

            return view('sms.sent', ['data'=>$data]);

        elseif ( $id ) :

            $data = $this->sentSmsHistoryRepository->show_sms($id);
            return view('sms.show', ['data'=>$data]);
        endif;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function draft_create()
    {
        return view('sms.draft');
    }

    public function draft_index(SmsDraftRepository $draftRepository, $id=null)
    {
        $data = $draftRepository->paginate();
        return  view('sms.draftall', ['data'=>$data]);
    }

    public function postDraft(DraftSmsRequest $request,SmsDraftRepository $draftRepository)
    {
        //no middleware
        //validate
        //save to db
        $draftRepository->save($request->only('subject','recipients','message'));

        flash()->overlay('<b>Draft message saved<b>', 'Violaaa');
        return Redirect::back();
    }

}
