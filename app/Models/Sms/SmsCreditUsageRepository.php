<?php namespace App\Models\Sms;


class SmsCreditUsageRepository {

    public function save($user_id,$sms_id,$units,$comment=null)
    {
        return SmsCreditUsage::create([
            'user_id'=>$user_id,
            'sms_history_id'=>$sms_id,
            'used_units' => $units,
            'comment' => $comment
        ]);
    }
} 