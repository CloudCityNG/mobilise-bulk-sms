<?php

namespace App\Http\Controllers;

use App\Repository\ContactRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ContactRepository $repository
     * @return \Illuminate\Http\Response
     */
    public function index(ContactRepository $repository)
    {
        $data = $repository->getAllContactsNotInGroup();
        return view('kanda.contacts.index', compact('data'));
    }



    public function newContact(Request $request, ContactRepository $repository)
    {
        if ( $request->ajax() )
        {
            $r = $request->only('firstname','lastname','email','gsm','gsm2','custom');
            $repository->new_contact($r);
            $out = view('ajax.kanda.contacts', ['data'=> $repository->getAllContactsNotInGroup()])->render();
            return response()->json(['success' => true, 'html' => $out]);
        }
    }

}
