<?php

namespace App;

use Mail;
use App\Mail\TriggerMet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Trigger extends Model
{

    use SoftDeletes;
    protected $table = 'triggers';
    protected $fillable = [
        "event_type_id", "level", "user_id", "pair_id"
    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function pair()
    {
    	return $this->belongsTo(Pair::class, 'pair_id', 'id');
    }

    public function event(){
    	return $this->belongsTo(EventType::class, 'event_type_id', 'id');
    }

    public function isMet()
    {
    	switch ($this->event->event_type_name) {
    		case 'less':
    			if($this->pair->exchange_rate < $this->level)
    				return true;
    			break;
    		case 'more':
    			if($this->pair->exchange_rate > $this->level)
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
    	Mail::to($this->owner->email)->queue(new TriggerMet($this));
    	$this->email_sent = true;
        $this->save();
    }

    public static function validate(Request $request)
    {
        $attributes = $request->validate([
            'event_type_id' => ['required', 'integer', 'exists:event_types,id'],
            'level'   => ['required'],
        ]);
        return $attributes;
    }
}
