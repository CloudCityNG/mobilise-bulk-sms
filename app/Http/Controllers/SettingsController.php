<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserDetailRequest;
use App\Repository\UserDetailRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function profile()
    {
        return view('settings.profile', ['userSidebar'=>true]);
    }


    public function postProfile(UserDetailRequest $request, UserDetailRepository $repository)
    {
        $inputs = array_map('set_null', $request->only('firstname', 'lastname', 'phone', 'address', 'dob'));
        $repository->save( $inputs );
        flash()->overlay('Profile Updated Successfully');
        return redirect()->back();
    }


    public function security()
    {
        return view('settings.security', ['userSidebar'=>true]);
    }





}
