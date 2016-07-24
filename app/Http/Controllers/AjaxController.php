<?php
namespace App\Http\Controllers;

use App\Http\Forms\QuicSmsForm;
use App\Jobs\NewContactCommand;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\NewContact;
use App\Http\Requests\NewGroup;
use App\Lib\Services\PhoneNumber\PhoneUtil;
use App\Repository\GroupRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function jobInfo(QuicSmsForm $form)
    {
        return $form->save();
    }



    public function newContact(NewContact $request)
    {
        if ($request->ajax())
        {
            $r = $request->only('gsm','email','firstname','lastname','birthdate','custom');
            $this->dispatch(new NewContactCommand($r, Auth::user()));
            return json_encode(['success'=>true]);
        }
    }


    public function newGroup(NewGroup $request)
    {
        if ($request->ajax())
        {
            $inputs = $request->only('group_name', 'group_description');
            $this->dispatch(new \App\Jobs\NewGroup($inputs, Auth::user()));
            return json_encode(['success'=>true]);
        }
    }


    public function getGroup()
    {
        $empty_array["data"] = GroupRepository::getGroup();
        return $empty_array;
    }


    public function returnContactsRaw()
    {
        $all = Auth::user()->contacts()->get();
        $out = view('ajax.contacts', ['data'=>$all])->render();
        return response()->json(['success'=>true, 'html'=> $out]);
    }

}
