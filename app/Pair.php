<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pair extends Model
{
    public function owner()
    {
    	return $this->belongsTo(User::class);
    }

    public function from()
    {
    	return $this->belongsTo(Currency::class, 'from_id');
    }

    public function to()
    {
    	return $this->belongsTo(Currency::class, 'to_id');
    }

    public function triggers()
    {
        return $this->hasMany(Trigger::class);
    }
}
