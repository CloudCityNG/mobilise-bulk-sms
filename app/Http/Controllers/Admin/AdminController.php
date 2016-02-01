<?php

namespace App\Http\Controllers\Admin;

use App\Repository\UserRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function search()
    {
        return view('kanda.admin.search');
    }


    public function postSearch(Request $request, UserRepository $repository)
    {
        $this->validate($request, [
            'search'    => 'required'
        ]);

        $u = $repository->searchByEmail($request->get('search'));

        return view('kanda.admin.search', ['users'=>$u]);
    }
}
