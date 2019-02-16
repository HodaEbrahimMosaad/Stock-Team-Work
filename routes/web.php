<?php


use App\Jobs\SendEmail;
use App\Mail\SendEmailMailable;
use Illuminate\Support\Facades\Mail;

Route::get('/', function (){return view('welcome');});

// temp, to be deleted
Route::get('/ho', 'HomeController@index');


Route::resource('/pairs', 'PairController')->middleware('verified');
Route::post('pairs/restore', 'PairController@restore')->middleware('verified');
Route::post('pairs/per_destroy', 'PairController@per_destroy')->middleware('verified');


Route::resource('/triggers', 'TriggerController')->middleware('verified');
Route::post('/triggers/store/{pair}', 'TriggerController@store')->middleware('verified');
Route::post('triggers/per_destroy', 'TriggerController@per_destroy')->middleware('verified');
Route::post('triggers/restore', 'TriggerController@restore')->middleware('verified');

//Route::get('/home', 'PairController@index')->name('home');
//Route::get('/pairs', 'PairController@getPairs')->name('pairs');


Auth::routes(['verify' => true]);

Route::get('sendEmail',function (){
//    SendEmail::dispatch()->delay(now()->addSeconds(5));
//   return 'done';
});
