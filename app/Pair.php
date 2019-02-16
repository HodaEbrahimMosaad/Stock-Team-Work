<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;


class Pair extends Model
{
    use SoftDeletes;

    protected $table = 'pairs';
    protected $fillable = [
      "user_id", "from_id", "to_id", "duration", "exchange_rate"
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

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
    	return $this->belongsTo(Currency::class, 'to_id', 'id');
    }

    public function triggers()
    {
        return $this->hasMany(Trigger::class);
    }

    public function needsSync()
    {
        $newDate = $this->updated_at;
        $newDate->hour += $this->duration;
        if($newDate > Carbon::now()){
            return false;
        }
        return true;
    }

    public function sync($cl)
    {
        //save old to History
        PairHistory::create([
            'from_id'=>$this->from_id,
            'to_id'=>$this->to_id,
            'exchange_rate'=>$this->exchange_rate
        ]);

        $to_name   = $this->to->currency_name;
        $from_name = $this->from->currency_name;
        $transform = $from_name.$to_name;
        $response = $cl->live([$to_name]);
        $this->exchange_rate = $response->quotes->$transform;
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
            'duration'=> ['required', 'integer']
        ]);
        return $attributes;
    }
}
