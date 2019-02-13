<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    //
    public function name()
    {
    	return $this->event_type_name;
    }
}
