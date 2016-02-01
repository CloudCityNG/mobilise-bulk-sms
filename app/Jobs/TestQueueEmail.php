<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Lib\Mailer\LogEmail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestQueueEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @param LogEmail $email
     * @return void
     */
    public function handle(LogEmail $email)
    {
        return $email->testEmailQueue('Test Queue Email');
    }
}
