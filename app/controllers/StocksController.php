<?php

class StocksController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth');
    }

    public function getList()
    {
        return View::make('stocks.index', array('stocks' => Stock::get()));
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

        return View::make('stocks.show', array('datas' => $values, 'stock' => $stock, 'notes' => $notes));
    }

}
