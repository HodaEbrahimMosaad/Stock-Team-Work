<?php




Route::get('/', function (){return view('welcome');});

// temp, to be deleted
Route::get('/ho', 'HomeController@index');

Route::resource('/pairs', 'PairController')->middleware('verified');
Route::resource('/triggers', 'TriggerController')->except(['index'])->middleware('verified');

Auth::routes(['verify' => true]);
