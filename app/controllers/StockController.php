<?php

class StockController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth');
    }

    public function stock($name)
    {
        $stockID = Stock::where('symbol', $name)->pluck('id');
        $values = Value::where('stock_id', $stockID)
            ->orderBy('date', 'desc')
            ->take(10)
            ->get();

        return View::make('stocktable', array('datas' => $values));
    }

}
