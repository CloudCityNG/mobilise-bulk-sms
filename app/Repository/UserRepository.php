<?php namespace App\Repository;


use App\User;
use Illuminate\Support\Facades\Auth;

class UserRepository {

    /**
     * Create a new user
     * @param $username
     * @param $email
     * @param $password
     * @return static
     */
    public function save($username, $email, $password)
    {
        return User::create( compact('username', 'email', 'password') );
    }


    public function createSMSAccount($user)
    {

    }


    public function changePassword($email,$currentPassword, $newPassword)
    {
        $user = Auth::user();
        $user->password = $newPassword;
        $user->save();
        return $user;
    }

} 