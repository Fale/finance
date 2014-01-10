<?php

class StocksController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth');
    }

    public function getPeaks()
    {
        if (Input::get('percentile', 10) >= 0)
            $deltaSymbol = '>=';
        else
            $deltaSymbol = '<=';

        $values = Value::where('delta', $deltaSymbol, Input::get('percentile', 10))
            ->where('date', '>=', Input::get('from', Carbon::now()->subWeek()))
            ->where('date', '<=', Input::get('to', Carbon::now()))
            ->get();

        return View::make('table', array('datas' => $values));
    }

}
