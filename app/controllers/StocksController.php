<?php

class StocksController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth');
    }

    public function getImport($market, $symbol, $onlyNew = false)
    {
        $url = 'http://ichart.yahoo.com/table.csv?s=' . trim($symbol);
        if ($onlyNew) {
            $t = strtotime(Stock::where('symbol', $symbol)->pluck('last'));
            if (date('n', $t) >= 1)
                $url.= '&a=' . (date('n', $t) - 1);
            else
                $url.= '&a=' . date('n', $t);
            $url.= '&b=' . date('j', $t);
            $url.= '&c=' . date('Y', $t);
        }

        $id = Stock::where('symbol', $symbol)->pluck('id');
        $file_headers = @get_headers($url);
        if($file_headers[0] == 'HTTP/1.1 404 Not Found')
            return 0;
        else {
            $handle = @fopen($url, 'r');
            if ( !$handle ) {
                echo 'fopen failed';
                return 0;
            }
        }
        $l = 0;
        while (($data = fgetcsv($handle, 5000, ",")) !== FALSE) {
            $l ++;
            if ($l == 1)
                continue;
       	    $datas[$data[0]]['stock_id'] = (int) $id;
            $datas[$data[0]]['date'] = $data[0];
            $datas[$data[0]]['open'] = $data[1];
            $datas[$data[0]]['close'] = $data[4];
            $datas[$data[0]]['high'] = $data[2];
            $datas[$data[0]]['low'] = $data[3];
            $datas[$data[0]]['volume'] = (int) $data[5];
            $datas[$data[0]]['delta'] = (($data[4] - $data[1]) / $data[1]) * 100;
            $datas[$data[0]]['absdelta'] = (($data[2] - $data[3]) / $data[2]) * 100;
        }

        $present = Value::where('stock_id', $id)->lists('id', 'date');

        $real = array_diff_key($datas, $present);
        foreach ($real as $data) {
        	Value::create($data);
        }

        $last = max(array_keys($datas));
        Stock::find($id)->update(array('last' => $last));
        Stock::find($id)->update(array('value' => $datas[$last]['close']));

        return count($real);
    }

    public function getPeaks()
    {
        $percentile = Input::get('percentile', 10);
        $from = Input::get('from', Carbon::now()->subWeek());
        $to = Input::get('to', Carbon::now());
        $market = Input::get('market', 'NASDAQ');

        if ($percentile >= 0)
            $deltaSymbol = '>=';
        else
            $deltaSymbol = '<=';

        $values = Value::where('delta', $deltaSymbol, $percentile)
            ->where('date', '>=', $from)
            ->where('date', '<=', $to)
            ->get();

        return View::make('table', array('datas' => $values));
    }
}
