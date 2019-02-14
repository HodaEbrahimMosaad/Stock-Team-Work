<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Pair extends Model
{
    protected $guarded = [];

    public function owner()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
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

    public function needsSync()
    {
        if($this->updated_at->hour + $this->duration > Carbon::now()){
            return true;
        }
        return false;
    }

    public function sync($cl)
    {
        $to_n = $this->to->currency_name;
        $to_n = $this->from->currency_name;
        $trnsform = $to_n.$to_n;
        $this->exchange_ratio = json_decode($cl->live([$to_n]))->quotes->$trnsform;
        $this->save();
    }


    public static function syncIfNeeded($pairs, $cl)
    {
        foreach($pairs as $pair)
        {
            if($pair->needsSync())
            {
                $pair->sync($cl);
            }
        }
    }

    public static function validate(Request $request)
    {
        $attributes = $request->validate([
            'from_id' => ['required', 'integer', 'exists:currencies,id'],
            'to_id'   => ['required', 'integer', 'exists:currencies,id'],
            'duration'=> ['required', 'integer'],
            'exchange_rate' => ['required', 'integer']
        ]);
        return $attributes;
    }
}
