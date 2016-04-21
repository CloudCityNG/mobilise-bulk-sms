<?php

namespace App\Console\Commands;

use App\Lib\Sms\DlrHandler;
use Illuminate\Console\Command;

class UpdateDlr extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dlr:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param DlrHandler $handler
     * @return mixed
     */
    public function handle(DlrHandler $handler)
    {
        $this->info("Start.......");
        $handler->clean_table();
        $this->info("Finish.......");
    }
}
