<?php

Route::get('/', array('before' => 'auth', function() {return View::make('home');}));
Route::controller('stocks', 'StocksController');
Route::controller('users', 'UsersController');
Route::controller('queries', 'QueriesController');
