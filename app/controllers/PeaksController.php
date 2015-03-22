<?php

class PeaksController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth');
    }

    public function getPeaks()
    {
        if (Input::get('percentile', 10) >= 0)
            $deltaSymbol = '>=';
        else
            $deltaSymbol = '<=';

        $values = Value::where('ocdelta', $deltaSymbol, Input::get('percentile', 10))
            ->where('date', '>=', Input::get('from', Carbon::now()->subWeek()))
            ->where('date', '<=', Input::get('to', Carbon::now()))
            ->where('volume', '>=', Input::get('volume', 1000000))
            ->where('indexa', '>=', Input::get('indexa', 50))
            ->orderBy('date', 'desc')
            ->get();

        return View::make('table', array('datas' => $values));
    }

}
