<?php

Route::get('/', array('before' => 'auth', function() {return View::make('index');}));
Route::get('/stock', array('before' => 'auth', 'uses' => 'StocksController@getList'));
Route::get('/stock/{stock}', array('before' => 'auth', 'uses' => 'StocksController@stock'));
Route::get('peaks', array('uses' => 'PeaksController@getPeaks'));
Route::controller('users', 'UsersController');
Route::controller('queries', 'QueriesController');
Route::resource('notes', 'NotesController');
