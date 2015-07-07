<?php namespace App\Http\Controllers;

use App\Commands\NewContactCommand;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\NewContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller {


    public function newContact(NewContact $request)
    {
        if ($request->ajax())
        {
            $r = $request->only('gsm','gsm2','email','firstname','lastname','street','city','region','postcode','birthdate');
            $this->dispatch(new NewContactCommand($r, Auth::user()));
            return json_encode(['success'=>true]);
        }
    }

}
