<?php
namespace App\Repository;


use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactRepository {


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
        return Auth::user()->contacts()->where('id',$id);
    }


    public function getAllUserContacts()
    {
        return Auth::user()->contacts()->get();
    }


    public static function getAllContactsNotInGroup()
    {
        return DB::select('SELECT * FROM contacts WHERE id NOT IN (SELECT contact_id FROM contact_group) AND user_id = ?', [Auth::user()->id]);
    }

} 