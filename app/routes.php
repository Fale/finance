<?php

Route::get('/', array('before' => 'auth', 'uses' => 'IndexController@index'));
Route::get('/stock', array('before' => 'auth', 'uses' => 'StocksController@getList'));
Route::get('/stock/{symbol}/notes', array('before' => 'auth', 'uses' => 'StocksController@notes'))->where('symbol', '[A-Za-z]+');
Route::get('/stock/{stock}', array('before' => 'auth', 'uses' => 'StocksController@stock'));
Route::get('peaks', array('uses' => 'PeaksController@getPeaks'));
Route::controller('users', 'UsersController');
Route::controller('queries', 'QueriesController');
Route::resource('notes', 'NotesController');
