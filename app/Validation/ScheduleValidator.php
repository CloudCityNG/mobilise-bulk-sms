<?php
namespace App\Validation;

use Illuminate\Validation\Validator;

class ScheduleValidator extends Validator {


    public function validateSchedule($attribute, $value, $parameters)
    {
        $now = (new \DateTime())->getTimestamp();
        $schedule = (new \DateTime($value))->getTimestamp();

        if ( $schedule < $now )
            return false;
        if ( $schedule > $now )
            return true;
        else
            return false;
    }

}