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
    	return $this->belongsTo(User::class, 'user_id');
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
        if(array_sum(explode(':',$this->updated_at->hour)) + array_sum(explode(':',$this->duration)) > array_sum(explode(':',Carbon::now()))){
            return true;
        }
        return false;
    }

    public function sync($cl)
    {
        $to_name   = $this->to->currency_name;
        $from_name = $this->from->currency_name;
        $transform = $to_name.$from_name;
        $this->exchange_rate = json_decode($cl->live([$to_name]))->quotes->$transform;
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
        ],[] ,[
            'from_id' => 'First Currency',
            'to_id' => 'Second Currency',
            'exchange_rate' => 'Exchange Rate'
        ]);
        return $attributes;
    }
}
