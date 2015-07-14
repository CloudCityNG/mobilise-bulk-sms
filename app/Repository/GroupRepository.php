<?php
namespace App\Repository;


use App\Models\Group;
use Illuminate\Support\Facades\DB;

class GroupRepository {


    public static function getGroup()
    {
        $data = DB::table('groups')->select('id', 'group_name')->paginate(4);
        return $data;
    }
} 