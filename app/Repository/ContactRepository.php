<?php
namespace App\Repository;


use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class ContactRepository {


    public function save(Contact $contact)
    {
        return $contact->save();
    }


    public function del($id)
    {
        return Auth::user()->contacts()->where('id',$id)->delete();
    }


    public function get($id)
    {
        return Auth::user()->contacts()->where('id',$id);
    }

} 