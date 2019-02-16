<?php

namespace App;

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
        return $this->belongsTo(User::class, 'user_id');
    }
    public function pair()
    {
    	return $this->belongsTo(Pair::class);
    }
    public function event()
    {
        return$this->hasOne(EventType::class, 'id');
    }

    public static function validate(Request $request)
    {
        $attributes = $request->validate([
            'event_type_id' => ['required', 'integer', 'exists:event_types,id'],
            'level'   => ['required'],
        ],[] ,[
            'event_type_id' => 'Event Type',
            'level' => 'Level',
        ]);
        return $attributes;
    }
}
