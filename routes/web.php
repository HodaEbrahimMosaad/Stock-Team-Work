<?php


use App\Jobs\SendEmail;
use App\Mail\SendEmailMailable;
use Illuminate\Support\Facades\Mail;

Route::get('/', function (){return view('welcome');});

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::resource('/pairs', 'PairController')->middleware('verified')->middleware('verified');

Route::resource('/triggers', 'TriggerController')->except(['index'])->middleware('verified');

Auth::routes(['verify' => true]);