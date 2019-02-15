<?php

namespace App;

use Mail;
use App\Mail\TriggerMet;
use Illuminate\Database\Eloquent\Model;

class Trigger extends Model
{
    protected $guarded = [];

    public function pair()
    {
    	return $this->belongsTo(Pair::class, 'pair_id', 'id');
    }

    public function owner()
    {
    	return $this->pair->owner;
    }

    public function event(){
    	return $this->belongsTo(EventType::class, 'event_type_id', 'id');
    }

    public function isMet()
    {
    	switch ($this->event->event_type_name) {
    		case 'less':
    			if($this->level < $this->pair->exchange_rate)
    				return true;
    			break;
    		case 'more':
    			if($this->level > $this->pair->exchange_rate)
    				return true;
    			break;
    	}
    	return false;
    }

    public function notSentYet()
    {
    	return !$this->email_sent;
    }

    public function notify()
    {
    	Mail::to($this->owner()->email)->queue(new TriggerMet($this));
    	$this->email_sent = true;
    }
}
