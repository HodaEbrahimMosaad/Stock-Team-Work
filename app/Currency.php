<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{

	protected $fillable = ['currency_name'];
    //
    public function name()
    {
    	return $this->currency_name;
    }
}
