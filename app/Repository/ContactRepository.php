<?php
namespace App\Repository;


use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactRepository {

    const DEFAULT_PAGINATE_SIZE = 15;


    public function new_contact($inputs)
    {
        $inputs = array_map('trim', $inputs);
        $inputs = array_map('strtolower', $inputs);
        return Auth::user()->contacts()->save( new Contact($inputs));
    }

    public function save(Contact $contact)
    {
        return $contact->save();
    }


    public function del($id)
    {
        return Auth::user()->contacts()->where('id',$id)->delete();
    }


    public static function get($id)
    {
        return Auth::user()->contacts()->find($id);
    }


    public static function getMany($ids = [])
    {
        return Auth::user()->contacts()->find($ids);
    }


    public function getAllUserContacts()
    {
        return Auth::user()->contacts()->get();
    }


    public static function getAllContactsNotInGroup()
    {
        //return DB::select('SELECT * FROM contacts WHERE id NOT IN (SELECT contact_id FROM contact_group) AND user_id = ?', [Auth::user()->id])
        $contact_group = DB::table('contact_group')->get(['contact_id']);
        foreach ($contact_group as $id)
        {
            $g[] = $id->contact_id;
        }

        $row = DB::table('contacts')
            ->whereNotIn('id', $g)
            ->where('user_id', Auth::user()->id)
            ->orderBy('firstname')
            ->get();
            //->paginate(self::DEFAULT_PAGINATE_SIZE);
        return $row;
    }


    /**
     * Edit contact details
     * @param $id
     * @param $inputs
     */
    public static function editContact($id, $inputs)
    {
        return Auth::user()->contacts()->where('id', $id)->update($inputs);
    }

} 