<?php

Route::get('/', function() {return View::make('home');});
Route::controller('stocks', 'StocksController');
Route::controller('users', 'UsersController');
