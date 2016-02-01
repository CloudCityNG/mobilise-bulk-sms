<?php

namespace App\Repository;


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


    //achieved at SmsCreditRepository::createNewAccount
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


    /**
     * Create a social user via a first time social login.
     * @param $email
     * @param $username
     * @param $password
     * @param $social_auth_type
     * @param int $social_auth
     * @return static
     */
    public function createSocialUser($email, $username, $password, $social_auth_type, $social_auth=1)
    {
        return User::create( compact('email', 'username', 'password', 'social_auth', 'social_auth_type') );
    }


    /**
     * Get a User via her Email address
     * @param $email
     * @return mixed
     */
    public static function getUserByEmail($email)
    {
        return User::where(['email'=>$email])->get();
    }


    /**
     * Get a valid social user via her social network
     * @param $email
     * @param $provider
     * @return mixed
     */
    public static function getSocialUser($email, $provider)
    {
        return User::where(['email'=>$email, 'social_auth_type'=>$provider, 'social_auth'=>1])->get();
    }


    public static function searchByEmail($email)
    {
        $q = '%'.$email.'%';
        return User::where('email', 'like', $q)->get();
    }
}