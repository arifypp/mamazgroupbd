<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class DueCashCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'duecash:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'booking due cash send email';

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
            $booking = Booking::orderBy('id', 'desc')->get();
            foreach ($booking as $key => $value) {
                
                echo $value->id;
            }
    }
}
