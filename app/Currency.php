<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    //
    public function name()
    {
    	return $this->currency_name;
    }
}
