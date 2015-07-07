<?php
namespace App\Repository;


use App\Models\Contact;

class ContactRepository {


    public function save(Contact $contact)
    {
        return $contact->save();
    }

} 