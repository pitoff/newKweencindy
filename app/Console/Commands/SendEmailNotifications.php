<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendEmailNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send_email_notifications:sendEmailNotifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email messages from queue';

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
     * @return int
     */
    public function handle()
    {
        return 0;
    }
}
