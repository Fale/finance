<?php

Route::get('/', array('before' => 'auth', function() {return View::make('home');}));
Route::get('/stock/{stock}', array('before' => 'auth', 'uses' => 'StockController@stock'));
Route::controller('stocks', 'StocksController');
Route::controller('users', 'UsersController');
Route::controller('queries', 'QueriesController');
