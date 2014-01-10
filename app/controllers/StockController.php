<?php

class StockController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth');
    }

    public function stock($name)
    {
        $stock = Stock::where('symbol', strtoupper($name))->first();
        $values = Value::where('stock_id', $stock->id)
            ->orderBy('date', 'desc')
            ->take(10)
            ->get();

        return View::make('stocktable', array('datas' => $values, 'stock' => $stock));
    }

}
