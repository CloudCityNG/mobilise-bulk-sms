<?php

namespace App\Http\Controllers\Admin;

use App\Repository\UserRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    const paginate = 10;

    public function start($id)
    {
        $user = User::find($id);
        $orders = User::find($id)->order()->paginate(self::paginate);
        $transactions = User::find($id)->transaction()->paginate(self::paginate);
        return view('kanda.admin.user', ['orders'=>$orders ,'trans'=>$transactions, 'user'=>$user]);
    }
}
