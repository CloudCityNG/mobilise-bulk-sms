<?php
namespace App\Repository;


use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupRepository {


    /**
     * @var ContactRepository
     */
    private $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {

        $this->contactRepository = $contactRepository;
    }


    /**
     * @param $id
     */
    public static function userGroupContacts($id)
    {
        if ( Auth::user()->groups()->where('id', $id)->count() ) {
            return Group::find($id)->contacts()->get();
        }
        return false;
    }


    /**
     * @return mixed
     */
    public static function getGroup()
    {
        $data = DB::table('groups')->select('id', 'group_name')->paginate(4);
        return $data;
    }


    /**
     * @return mixed
     */
    public function getAllGroups()  //should be getAllUserGroups
    {
        return Auth::user()->groups()->get();
    }


    /**
     * @param $id
     * @return mixed
     */
    public function del($id)
    {
        //check if the record exists
        $q = Auth::user()->groups()->where('id',$id);
        if ( $q->count() ) {
            //delete corresponding contacts
            $this->contactRepository->del($id);
        }
        return $q->delete();
    }
} 