<?php
namespace App\Repository;


use App\Models\Contact;
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


    public static function createUserAndAddToGroup($group_id, Array $inputs = null)
    {
        $c = Auth::user()->contacts()->save(new Contact($inputs));
        $c->groups()->attach($group_id);
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
     * Get the logged in user group_id contacts.
     * @param $id
     */
    public static function userGroupContacts($id)
    {
        return Auth::user()->groups()->find($id)->contacts()->get();
        if (Auth::user()->groups()->where('id', $id)->count()) {
            return Group::find($id)->contacts()->get();
        }
        return false;
    }


    public static function userGroupContactsMany(Array $ids)
    {
        return Auth::user()->groups()->find($ids)->contacts()->get();
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