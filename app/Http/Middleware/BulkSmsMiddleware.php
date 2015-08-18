<?php namespace App\Http\Middleware;

use App\Repository\ContactRepository;
use App\Repository\GroupRepository;
use App\Repository\SmsCreditRepository;
use Closure;

class BulkSmsMiddleware
{

    const NO_CREDIT = 0;
    const NO_CREDIT_TEXT = 'You do not have enough credits to send SMS. Please buy more.';

    /**
     * @var ContactRepository
     */
    private $repository;
    /**
     * @var GroupRepository
     */
    private $groupRepository;

    function __construct(ContactRepository $repository, GroupRepository $groupRepository)
    {
        $this->repository = $repository;
        $this->groupRepository = $groupRepository;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //check user credit
        $user_credit = $request->user()->smscredit->available_credit;
        //if NO CREDIT at all handle
        if ($user_credit <= self::NO_CREDIT) {
            if ($request->ajax()) {
                return response()->json(['credit' => [self::NO_CREDIT_TEXT]], 422);
            }
            //@TODO set a sms/home route
            flash()->info(self::NO_CREDIT_TEXT);
            return redirect()->back()->withInput();
        }
        $recipients = '';
        //fetch all the contacts gms for the selected contacts
        if (is_array($request->get('contacts'))):
            $contacts = $this->repository->getMany($request->get('contacts'));
            foreach ($contacts as $contact):
                $recipients .= $contact->gsm . ',';
            endforeach;
        endif;

        //fetch all contacts from selected groups
        if ( is_array( $request->get('groups') ) ):
            foreach ( $request->get('groups') as $group_id ):
                $contact = $this->groupRepository->userGroupContacts($group_id);//[0]->gsm;
                //dig deep
                foreach ($contact as $con):
                    $recipients .= $con->gsm .',';
                endforeach;
            endforeach;
        endif;

        //calculate TOTAL CREDIT from no of recipients * sms pages
        $message = $request->get('message');
        $recipients = $recipients . $request->get('recipients');
        //dd($recipients);
        $total_units = SmsCreditRepository::getSmsBill($recipients, $message);
        dd($total_units);

        if ($user_credit < $total_units) {
            if ($request->ajax()) {
                return response()->json(['credit' => [self::NO_CREDIT_TEXT]], 422);
            }
            flash()->info(self::NO_CREDIT_TEXT);
            return redirect()->back()->withInput();
        }


        return $next($request);
    }

}
