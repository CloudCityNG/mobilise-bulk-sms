<?php
namespace App\Repository;


use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupRepository
{


    /**
     * @var ContactRepository
     */
    private $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {

        $this->contactRepository = $contactRepository;
    }


    public function createUserAndAddToGroup($id, Array $inputs = null)
    {
        if (Auth::user()->groups()->where('id', $id)->count()) {
            $r = Contact::store($inputs);
            Group::find($id)->contacts()->save($r);
        }
    }

    /**
     * Get logged-in user groups with contacts
     * @return mixed
     */
    public static function getUserGroupsWithContacts()
    {
        return Auth::user()->groups()->with('contacts')->get();
    }


    /**
     * Get the logged in user group_$id contacts.
     * @param $id
     */
    public static function userGroupContacts($id)
    {
        if (Auth::user()->groups()->where('id', $id)->count()) {
            return Group::find($id)->contacts()->get();
        }
        return false;
    }


    /**
     * Get all existing groups
     * @return mixed
     */
    public static function getGroup()
    {
        $data = DB::table('groups')->select('id', 'group_name')->paginate(4);
        return $data;
    }


    /**
     * Get all logged in-user groups
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
        $q = Auth::user()->groups()->where('id', $id);
        if ($q->count()) {
            //delete corresponding contacts
            $this->contactRepository->del($id);
        }
        return $q->delete();
    }
} 