<?php

namespace App\Console\Commands;

use App\Trigger;
use Illuminate\Console\Command;

class CheckTriggers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:triggers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check every trigger and send email if one is met.';

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
     * @return mixed
     */
    public function handle()
    {
        $triggers = Trigger::all();
        foreach ($triggers as $trigger) {
            if($trigger->isMet() && $trigger->notSentYet()){
                $trigger->notify();
            }
        }
    }
}
