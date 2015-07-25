<?php namespace App\Http\Controllers;

use App\Commands\NewContactCommand;
use App\Commands\NewGroup;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\NewContactRequest;
use App\Http\Requests\NewGroupRequest;
use App\Models\Contact;
use App\Models\Group;
use App\Repository\GroupRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressBookController extends Controller {


    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
	{
		return view('addressbook.index')
            ->with('data', GroupRepository::getGroup())
            ;
	}


    public function start()
    {
        //$all = Contact::where('user_id', Auth::user()->id)->get();
        $all = Auth::user()->contacts()->get();
        return view('addressbook.start', ['data'=>$all]);
    }


    public function groups()
    {
        $groups = Group::where('user_id', Auth::user()->id)->with('contacts')->get();
        return view('addressbook.groups', ['data'=>$groups]);
    }


    public function newContact()
    {
        return view('addressbook.new-contact');
    }

    //get request for ajax create new contact
    public function getNewContact(NewContactRequest $request)
    {
        if ($request->ajax())
        {
            $r = $request->only('gsm','email','firstname','lastname','birthdate','custom');
            $this->dispatch(new NewContactCommand($r, Auth::user()));

            $all = Auth::user()->contacts()->get();
            $out = view('ajax.contacts', ['data'=>$all])->render();
            return response()->json(['success'=>true, 'html'=> $out]);
        }
    }

    //get request for ajax create new group
    public function getNewGroup(NewGroupRequest $request)
    {
        if ($request->ajax())
        {
            $inputs = $request->only('group_name', 'group_description');
            $this->dispatch(new NewGroup($inputs,Auth::user()));

            $all = Auth::user()->groups()->with('contacts')->get();
            $out = view('ajax.groups', ['data'=>$all])->render();
            return response()->json(['success'=>true, 'html'=> $out]);
        }
    }
}
