<?php




Route::get('/', function (){return view('welcome');});

// temp, to be deleted
Route::get('/ho', 'HomeController@index');

Route::resource('/home', 'PairController')->middleware('verified');
Auth::routes(['verify' => true]);
