<?php

Route::get('import/{symbol}', array('uses' => 'ValuesController@importValues'));