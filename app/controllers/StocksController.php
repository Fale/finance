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

        if(!$stock)
            App::abort(404);

        $values = Value::where('stock_id', $stock->id)
            ->orderBy('date', 'desc')
            ->take($days)
            ->get();

        $notes = Note::where('stock_id', $stock->id)->where('happens_on', '>=', Carbon::now())->orderBy('happens_on')->get();

        return View::make('stocks.show', array('datas' => $values, 'stock' => $stock, 'notes' => $notes));
    }

    public function notes($symbol)
    {
        $stock = Stock::where('symbol', strtoupper($symbol))->first();
        if(!$stock)
            App::abort(404);
        $notes = Note::where('stock_id', $stock->id)->orderBy('happens_on', 'desc')->get();
        return View::make('stocks.notes', array('stock' => $stock, 'notes' => $notes));
    }
}
