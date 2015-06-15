<?php namespace App\Repository;


use App\Models\Sms\SmsDraft;
use Illuminate\Support\Facades\Auth;

class SmsDraftRepository {

    const DEFAULT_PAGINATE_SIZE = 6;

    public function save($request)
    {
        return Auth::user()->draftsms()->save(
            SmsDraft::store($request)
        );
    }

    public function paginate($per_page=self::DEFAULT_PAGINATE_SIZE)
    {
        return Auth::user()->draftsms()
            ->with('user')
            ->latest()
            ->paginate($per_page);
    }
} 