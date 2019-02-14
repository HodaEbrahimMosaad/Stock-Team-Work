<?php
// currencies
Currency::create(['currency_name'=>'USD']);
Currency::create(['currency_name'=>'EGP']);
Currency::create(['currency_name'=>'EUR']);
Currency::create(['currency_name'=>'AFN']);
Currency::create(['currency_name'=>'AUD']);
Currency::create(['currency_name'=>'BHD']);
Currency::create(['currency_name'=>'CAD']);
Currency::create(['currency_name'=>'INR']);
Currency::create(['currency_name'=>'IRR']);
Currency::create(['currency_name'=>'IQD']);
Currency::create(['currency_name'=>'SAR']);
Currency::create(['currency_name'=>'TRY']);
Currency::create(['currency_name'=>'AED']);
Currency::create(['currency_name'=>'KWD']);


//eventTypes
EventType::create(['event_type_name'=>'less']);
EventType::create(['event_type_name'=>'more']);

// verify users email
use Carbon\Carbon;
$u = User::first();
$u->email_verified_at = Carbon::now();
$u->save();

// pair
$pair = factory('App\Pair')->create(['user_id'=>$u->id]);

// triggers
factory('App\Trigger')->create(['user_id'=>$u->id, 'pair_id'=>$pair->id]);
factory('App\Trigger')->create(['user_id'=>$u->id, 'pair_id'=>$pair->id]);
