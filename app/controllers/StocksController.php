<?php

class StocksController extends BaseController {

    public function getImport($market, $symbol)
    {
        $id = Stock::where('symbol', $symbol)->pluck('id');
        if(!file_exists('http://ichart.yahoo.com/table.csv?s=' . $symbol, 'r'))
            exit;
        else
            $handle = fopen('http://ichart.yahoo.com/table.csv?s=' . $symbol, 'r');
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
            $datas[$data[0]]['delta'] = ($data[4] - $data[1]) / $data[1];
            $datas[$data[0]]['absdelta'] = ($data[2] - $data[3]) / $data[2];
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

    public function getPeaks($market, $percentile, $date = '1900-01-01')
    {
        if ($percentile >= 0)
            $values = Value::where('delta', '>=', $percentile * 100)->where('date', '>=', $date)->get();
        else
            $values = Value::where('delta', '<=', $percentile * 100)->where('date', '>=', $date)->get();

        foreach ($values as $value)
        {
            echo $value->stock->symbol . ' ';
            echo $value->date . ' ';
            echo Value::toDouble($value->delta);
            echo "<br>";
        }
    }
}
