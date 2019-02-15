<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trigger extends Model
{
    public function pair()
    {
    	return $this->belongsTo(Pair::class);
    }
    public function event()
    {
        return$this->hasOne(EventType::class, 'id');
    }
}
