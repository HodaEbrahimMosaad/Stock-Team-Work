<?php


Route::get('/', function (){return view('welcome');});

Route::get('/home', function(){
    return redirect('pairs');
});


Route::resource('/pairs', 'PairController')->middleware('verified');
Route::post('pairs/restore', 'PairController@restore')->middleware('verified');
Route::post('pairs/per_destroy', 'PairController@per_destroy')->middleware('verified');
Route::get('/sync', 'PairController@sync')->name('pairs.sync')->middleware('verified');


Route::resource('/triggers', 'TriggerController')->middleware('verified');
Route::post('/triggers/store/{pair}', 'TriggerController@store')->middleware('verified');
Route::post('triggers/per_destroy', 'TriggerController@per_destroy')->middleware('verified');
Route::post('triggers/restore', 'TriggerController@restore')->middleware('verified');

Route::get('/data', 'PairController@getPairs')->name('pairs');

Auth::routes(['verify' => true]);