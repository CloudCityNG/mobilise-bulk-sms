<?php
/**
 * Created by PhpStorm.
 * User: segun
 * Date: 7/7/2016
 * Time: 7:34 AM
 */

namespace App\Validation;


use App\User;
use Illuminate\Support\Facades\Hash;

class ApiValidators
{
    /**
     * @var User
     */
    private $user;


    /**
     * ApiValidators constructor.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function validateAuth($attribute, $value, $parameters, $validator)
    {
        $base64Decoded = base64_decode($value);
        $decodedElements = explode(":", $base64Decoded);
        if (is_array($decodedElements))
        {
            $user = $this->user->getUser($decodedElements[0])->first();
            if ($user && Hash::check($decodedElements[1], $user->password))
                return true;
            else
                return false;
        }
        return false;
    }


    public function validateTo($attribute, $value, $parameters, $validator)
    {

    }


    public function compareTime($attribute, $value, $parameters, $validator)
    {
        //value should be low
        $now = new \DateTime("now", new \DateTimeZone('UTC'));
        $nowTimestamp = $now->getTimestamp();

        //value should be high
        $future = new \DateTime($value);
        $future = $future->setTimezone(new \DateTimeZone('UTC'));
        $futureTimestamp = $future->getTimestamp();

        if ( (int) $futureTimestamp > (int) $nowTimestamp ):
            return true;
        endif;
        return false;
    }


    public function validateScheduleDateTime($attribute, $value, $parameters, $validator)
    {
        //value should be low
        $now = new \DateTime("now", new \DateTimeZone('UTC'));
        $nowTimestamp = $now->getTimestamp();

        //value should be high
        $future = new \DateTime($value);
        $futureTimestamp = $now->getTimestamp();

        if ( $now < $future ):
            return false;
        endif;


        //convert to new timezone
        $future = $future->setTimezone('UTC');



    }


    public function validateFrom($attribute, $value, $parameters, $validator)
    {
        
    }
}