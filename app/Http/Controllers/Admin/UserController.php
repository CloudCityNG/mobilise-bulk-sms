<?php

namespace App\Http\Controllers\Admin;

use App\Repository\UserRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function start($id)
    {
        $orders = User::find($id)->order()->get();
        $transactions = User::find($id)->transaction()->get();
        return view('kanda.admin.user', ['orders'=>$orders, 'trans'=>$transactions]);
    }
}
