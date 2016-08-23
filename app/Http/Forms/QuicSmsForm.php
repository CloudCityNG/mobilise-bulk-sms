<?php
namespace App\Http\Forms;

use App\Jobs\SendSmsJob;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

class QuicSmsForm extends Form
{
    use DispatchesJobs;

    protected $rules = [
        'sender' => 'required|min:3|max:11',
        'recipients' => 'required',
        'message' => 'required|min:1|max:480',
        'schedule' => 'boolean',
        'datetime' => 'required_with:schedule|compare_time',
        'flash' => 'boolean',
    ];

    protected $messages = [
        'datetime.compare_time' => 'Scheduled Datetime is behind present time.',
    ];


    public function persist()
    {
        $this->request->merge(['user_id' => $this->request->user()->id]);
        $job = (new SendSmsJob($this->fields()));
        $this->dispatch($job);
    }

}