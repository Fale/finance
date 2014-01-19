<?php

class StockController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth');
    }

    public function stock($name)
    {
        $days = Input::get('days', 100);
        $stock = Stock::where('symbol', strtoupper($name))->first();
        $values = Value::where('stock_id', $stock->id)
            ->orderBy('date', 'desc')
            ->take($days)
            ->get();

        $notes = Note::where('stock_id', $stock->id)->get();

        return View::make('stocktable', array('datas' => $values, 'stock' => $stock, 'notes' => $notes));
    }

}
