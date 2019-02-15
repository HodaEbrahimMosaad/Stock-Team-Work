<?php


use App\Jobs\SendEmail;
use App\Mail\SendEmailMailable;
use Illuminate\Support\Facades\Mail;

Route::get('/', function (){return view('welcome');});

// temp, to be deleted
Route::get('/ho', 'HomeController@index');

Route::resource('/pairs', 'PairController')->middleware('verified');

//Route::get('/home', 'PairController@index')->name('home');
//Route::get('/pairs', 'PairController@getPairs')->name('pairs');


Auth::routes(['verify' => true]);

Route::get('sendEmail',function (){
//    SendEmail::dispatch()->delay(now()->addSeconds(5));
//   return 'done';
});
