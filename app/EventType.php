<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
	protected $fillable = ['event_type_name'];

    //
    public function name()
    {
    	return $this->event_type_name;
    }
}
