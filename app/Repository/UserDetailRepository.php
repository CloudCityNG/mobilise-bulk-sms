<?php

namespace App\Repository;


use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;

class UserDetailRepository {


    public function getDetails()
    {
        $details = Auth::user()->userdetail->all();
    }


    public static function save(array $inputs)
    {
        if ( Auth::user()->userdetails()->exists() )
        {
            return Auth::user()->userdetails()->update($inputs);
        }

        return Auth::user()->userdetails()->save( new UserDetail($inputs));
    }
}