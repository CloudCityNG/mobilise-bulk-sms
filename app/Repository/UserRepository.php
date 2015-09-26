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
        $user->password = bcrypt($newPassword);
        $user->save();
        return $user;
    }


    public function createSocialUser($email, $username, $password, $social_auth_type, $social_auth=1)
    {
        return User::create( compact('email', 'username', 'password', 'social_auth', 'social_auth_type') );
    }


    public static function getUserByEmail($email)
    {
        return User::where(['email'=>$email])->get();
    }


    public static function getSocialUser($email, $provider)
    {
        return User::where(['email'=>$email, 'social_auth_type'=>$provider, 'social_auth'=>1])->get();
    }

}