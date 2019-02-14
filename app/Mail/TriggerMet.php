<?php

namespace App\Mail;

use \App\Trigger;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TriggerMet extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    private $trigger;

    public function __construct(Trigger $trigger)
    {
        $this->trigger = $trigger;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $trigger = $this->trigger;
        return $this->view('trigger.triggerMet', compact('trigger'));
    }
}
