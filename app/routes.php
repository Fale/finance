<?php

Route::get('/', array('before' => 'auth', function() {return View::make('home');}));
Route::get('/stock', array('before' => 'auth', 'uses' => 'StockController@getList'));
Route::get('/stock/{stock}', array('before' => 'auth', 'uses' => 'StockController@stock'));
Route::get('peaks', array('uses' => 'StocksController@getPeaks'));
Route::controller('users', 'UsersController');
Route::controller('queries', 'QueriesController');


Route::resource('notes', 'NotesController');

Route::resource('notes', 'NotesController');

Route::resource('notes', 'NotesController');
